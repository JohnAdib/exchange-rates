<?php

declare(strict_types=1);

namespace models;

use Exception;
use Phalcon\Mvc\Model;
use library\EnvHelper;
use library\UrlHelper;
use library\CacheHelper;
use stdClass;
use library\xchange\Symbols;
use library\xchange\ExchangeRatesApi;

class ExchangeModel extends Model
{
    const CACHE_TTL = 60;
    const SYMBOLS = [
        'USD', 'EUR', 'GBP', 'CHF', 'CAD', 'AUD',
        'JPY', 'CNY', 'RUB', 'IRR', 'AED', 'TRY', 'IQD', 'INR',
    ];

    public function load(): object
    {
        $urlHelper = new UrlHelper();
        $cacheName = 'apiData-' . $urlHelper->getParam('base');
        $cache = new CacheHelper($cacheName, self::CACHE_TTL);
        if ($urlHelper->getParam('force')) {
            $cache->delete();
        }
        if ($cache->has()) {
            return $cache->get();
        }
        $apiData = self::getDataFromApi();
        if ($apiData->okay === true) {
            $cache->set($apiData);
        }
        return $apiData;
    }

    public function getDataFromApi(): object
    {
        $result = new stdClass();
        $result->okay = true;
        $result->status = 200;
        $result->msg = "OK";
        $result->ttl = self::CACHE_TTL;
        $result->dateUpdate = date('Y-m-d H:i:s');
        $result->dateExpire = date('Y-m-d H:i:s', strtotime("+" . self::CACHE_TTL * 60 . " seconds"));
        $result->latest = null;
        $result->symbols = Symbols::getFiltered(self::SYMBOLS);
        try {
            $apikey = (new EnvHelper)->getApiKey();
            $baseCurrency = (new UrlHelper())->getParam('base');
            $api = new ExchangeRatesApi($apikey, self::SYMBOLS, $baseCurrency);
            $result->latest = $api->fetch();
            if (count($result->latest) === 1 && isset($result->latest["message"])) {
                throw new Exception($result->latest["message"]);
            }
        } catch (Exception $e) {
            $result->okay = false;
            $result->status = 506;
            $result->msg = $e->getMessage();
        }
        return $result;
    }
}