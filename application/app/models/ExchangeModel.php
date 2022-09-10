<?php

declare(strict_types=1);

namespace models;

use Exception;
use Phalcon\Cache;
use Phalcon\Cache\AdapterFactory;
use Phalcon\Mvc\Model;
use Phalcon\Storage\SerializerFactory;
use library\EnvHelper;
use library\UrlHelper;
use xchange\Symbols;
use xchange\ExchangeRatesApi;

class Exchange extends Model
{
    const CACHE_TTL = 60 * 60; // 60 minute
    const SYMBOLS = [
        'USD', 'EUR', 'GBP', 'CHF', 'CAD', 'AUD',
        'JPY', 'CNY', 'RUB', 'IRR', 'AED', 'TRY', 'IQD', 'INR',
    ];

    public function load()
    {
        $serializerFactory = new SerializerFactory();
        $adapterFactory    = new AdapterFactory($serializerFactory);
        $options = [
            'defaultSerializer' => 'Json',
            'lifetime'          => self::CACHE_TTL
        ];
        $adapter = $adapterFactory->newInstance('apcu', $options);
        $cache = new Cache($adapter);

        $urlHelper = new UrlHelper();
        $cacheName = 'apiData-' . $urlHelper->getParam('base');
        if ($urlHelper->getParam('force')) {
            $cache->delete($cacheName);
        }
        $cachedData = $cache->get($cacheName);
        if (isset($cachedData)) {
            return $cachedData;
        }
        $apiData = self::getDataFromApi();
        if ($apiData['okay'] === true) {
            $cache->set($cacheName, $apiData);
        }
        return $apiData;
    }

    public function getDataFromApi(): array
    {
        $okay = true;
        $status = 200;
        $msg = "OK";
        $apiResult = null;
        try {
            $apikey = (new EnvHelper)->getApiKey();
            $baseCurrency = (new UrlHelper())->getParam('base');
            $api = new ExchangeRatesApi($apikey, self::SYMBOLS, $baseCurrency);
            $apiResult = $api->fetch();
        } catch (Exception $e) {
            $okay = false;
            $status = 506;
            $msg = $e->getMessage();
        }
        if (is_array($apiResult) && count($apiResult) === 1 && isset($apiResult["message"])) {
            $okay = false;
            $status = 400;
            $msg = $apiResult["message"];
        }
        $expiredAtTimestamp = strtotime("+" . self::CACHE_TTL . " seconds");
        return [
            "okay" => $okay,
            "status" => $status,
            "msg" => $msg,
            "ttl" => self::CACHE_TTL,
            "dateUpdate" => date('Y-m-d H:i:s'),
            "dateExpire" => date('Y-m-d H:i:s', $expiredAtTimestamp),
            "latest" => $apiResult,
            "symbols" => Symbols::getFiltered(self::SYMBOLS),
        ];
    }
}