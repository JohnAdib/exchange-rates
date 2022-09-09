<?php

declare(strict_types=1);

namespace models;

use xchange\Symbols;
use xchange\ExchangeRatesApi;

class Exchange extends \Phalcon\Mvc\Model
{
    const SELECTED_SYMBOLS = [
        'USD', 'EUR', 'GBP', 'CHF', 'CAD', 'AUD',
        'JPY', 'CNY', 'RUB', 'IRR', 'AED', 'TRY', 'IQD', 'INR',
    ];

    public function load(string $API_KEY, string $baseCurrency): array
    {
        $status = true;
        $error = false;
        $apiResult = null;
        try {
            // get data from API
            $ExchangeRatesApi = new ExchangeRatesApi($API_KEY);
            $ExchangeRatesApi->setBase($baseCurrency);
            $ExchangeRatesApi->setSymbols(self::SELECTED_SYMBOLS);
            // $ExchangeRatesApi->fetch();
            $apiResult = $ExchangeRatesApi->getResponseJson();
        } catch (\Exception $e) {
            $status = false;
            $error = $e->getMessage();
        }

        $returnData = [
            "okay" => $status,
            "error" => $error,
            "latest" => $apiResult,
            "symbols" => Symbols::getFiltered(self::SELECTED_SYMBOLS),
        ];

        return $returnData;
    }
}