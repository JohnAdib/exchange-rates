<?php

declare(strict_types=1);

namespace models;

use xchange\Symbols;
use xchange\ExchangeRatesApi;

class Exchange extends \Phalcon\Mvc\Model
{
    public function load(string $API_KEY, string $baseCurrency): array
    {
        $symbols = new Symbols();
        $mySymbolsList = implode(',', $symbols->getFamous());

        $ExchangeRatesApi = new ExchangeRatesApi($API_KEY);
        $result = $ExchangeRatesApi->fetch($baseCurrency, $mySymbolsList);


        // Use Model for database Query
        $returnData = [
            "base" => $baseCurrency,
            "symbols" => $symbols->getFamous(),
            "symbolsList" => $mySymbolsList,
            "result" => $result
        ];

        return $returnData;
    }
}