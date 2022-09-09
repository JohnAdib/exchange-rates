<?php

declare(strict_types=1);

namespace models;

use xchange\Symbols;
use xchange\ExchangeRatesApi;

class Exchange extends \Phalcon\Mvc\Model
{
    const SELECTED_SYMBOLS = [
        'USD', 'EUR', 'GBP', 'CHF', 'CAD', 'AUD',
        'JPY', 'CNY', 'RUB', 'IRR', 'AED', 'TRY', 'IQD', 'INR1',
    ];

    public function load(string $API_KEY, string $baseCurrency): array
    {
        // get data from API
        $ExchangeRatesApi = new ExchangeRatesApi($API_KEY);
        $ExchangeRatesApi->setBase($baseCurrency);
        $ExchangeRatesApi->setSymbols(self::SELECTED_SYMBOLS);
        $ExchangeRatesApi->fetch();
        $result = $ExchangeRatesApi->getResponseJson();


        // Use Model for database Query
        $returnData = [
            "base" => $ExchangeRatesApi->getBase(),
            "symbols" => $ExchangeRatesApi->getSymbols(),
            // "symbolsList" => $mySymbolsList,
            "result" => $result
        ];

        return $returnData;
    }
}