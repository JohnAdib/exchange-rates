<?php

declare(strict_types=1);

namespace models;

use Exception;
use Phalcon\Di;
use Phalcon\Http\Request;
use Phalcon\Cache;
use Phalcon\Cache\AdapterFactory;
use Phalcon\Mvc\Model;
use Phalcon\Storage\SerializerFactory;
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
        $cacheName = 'apiData-' . $this->getBase();
        if ($this->getForce()) {
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
        $error = false;
        $apiResult = null;
        try {
            $apiKey = $this->getApiKey();
            $baseCurrency = $this->getBase();
            // get data from API
            $exchangeRatesApi = new ExchangeRatesApi($apiKey, $baseCurrency, self::SYMBOLS);
            $apiResult = $exchangeRatesApi->fetch();
        } catch (Exception $e) {
            $okay = false;
            $status = 400;
            $error = $e->getMessage();
        }
        if (count($apiResult) === 1 && isset($apiResult["message"])) {
            // error on api
            $okay = false;
            $status = 400;
            $error = $apiResult["message"];
        }
        $expiredAtTimestamp = strtotime("+" . self::CACHE_TTL . " seconds");
        return [
            "okay" => $okay,
            "status" => $status,
            "error" => $error,
            "ttl" => self::CACHE_TTL,
            "dateUpdate" => date('Y-m-d H:i:s'),
            "dateExpire" => date('Y-m-d H:i:s', $expiredAtTimestamp),
            "latest" => $apiResult,
            "symbols" => Symbols::getFiltered(self::SYMBOLS),
        ];
    }

    private function getBase(): string
    {
        $request = new Request();
        $baseCurrency = $request->getQuery('base', null, 'USD');
        if (!Symbols::isSymbolExist($baseCurrency)) {
            $baseCurrency = "USD";
        }
        return strtoupper($baseCurrency);
    }

    private function getForce(): string
    {
        $request = new Request();
        return $request->getQuery('force', null, "");
    }

    /**
     * @throws Exception
     */
    private function getApiKey(): string
    {
        $config = Di::getDefault()->getShared('config');
        $myApikey = $config->application->EXCHANGERATES_API_KEY;
        if (!$myApikey) {
            throw new Exception('Not Acceptable - API KEY NOT FOUND');
        }
        return $myApikey;
    }
}