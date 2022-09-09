<?php

declare(strict_types=1);

namespace models;

use Phalcon\Di;
use Phalcon\Config;
use Phalcon\Http\Request;
use Phalcon\Cache;
use Phalcon\Cache\AdapterFactory;
use Phalcon\Storage\SerializerFactory;
use xchange\Symbols;
use xchange\ExchangeRatesApi;


class Exchange extends \Phalcon\Mvc\Model
{
    const SELECTED_SYMBOLS = [
        'USD', 'EUR', 'GBP', 'CHF', 'CAD', 'AUD',
        'JPY', 'CNY', 'RUB', 'IRR', 'AED', 'TRY', 'IQD', 'INR',
    ];

    public function load()
    {
        $serializerFactory = new SerializerFactory();
        $adapterFactory    = new AdapterFactory($serializerFactory);
        $options = [
            'defaultSerializer' => 'Json',
            'lifetime'          => 60 * 60 // 60 min
        ];
        $adapter = $adapterFactory->newInstance('apcu', $options);
        $cache = new Cache($adapter);

        // cache each type of symbols
        $cacheName = 'apiData-' . $this->getBase();

        // if request force mode, delete cache
        if ($this->getForce()) {
            $cache->delete($cacheName);
        }
        // read from cache
        $cachedData = $cache->get($cacheName);
        if (isset($cachedData)) {
            return $cachedData;
        }
        // read from api and cache it
        $apiData = self::getDataFromApi();
        $saveCachedResult = $cache->set($cacheName, $apiData);

        return $apiData;
    }


    public function getDataFromApi(): array
    {
        $okay = true;
        $status = 200;
        $error = false;
        $apiResult = null;
        $apiKey = $this->getApiKey();
        $baseCurrency = $this->getBase();

        try {
            // get data from API
            $ExchangeRatesApi = new ExchangeRatesApi($apiKey);
            $ExchangeRatesApi->setBase($baseCurrency);
            $ExchangeRatesApi->setSymbols(self::SELECTED_SYMBOLS);
            $ExchangeRatesApi->fetch();
            $apiResult = $ExchangeRatesApi->getResponseJson();
        } catch (\Exception $e) {
            $okay = false;
            $status = 400;
            $error = $e->getMessage();
        }

        $returnData = [
            "okay" => $okay,
            "status" => $status,
            "error" => $error,
            "latest" => $apiResult,
            "symbols" => Symbols::getFiltered(self::SELECTED_SYMBOLS),
        ];
        return $returnData;
    }

    private function getBase()
    {
        $request = new Request();
        $baseCurrency = $request->getQuery('base', null, 'USD');

        if (!Symbols::isSymbolExist($baseCurrency)) {
            $baseCurrency = "USD";
        }

        return strtoupper($baseCurrency);
    }

    private function getForce()
    {
        $request = new Request();
        $forceMode = $request->getQuery('force', null, false);
        return $forceMode;
    }


    private function getApiKey()
    {
        $config = Di::getDefault()->getShared('config');
        $Exchangerates_API_KEY = $config->application->EXCHANGERATES_API_KEY;

        if (!$Exchangerates_API_KEY) {
            $error = [
                "okay" => false,
                "status" => 406,
                "error" => 'Not Acceptable - API KEY NOT FOUND',
            ];

            return $error;
        }
        return $Exchangerates_API_KEY;
    }
}