<?php
declare(strict_types=1);

namespace models;

use xchange\Symbols;

class Exchange extends \Phalcon\Mvc\Model
{
    public function load(string $API_KEY): array
    {
        $symbols = new Symbols();


        // Use Model for database Query
        $returnData = [
            "symbols" => $symbols->getFamous(),
            // "api" => $this->config->application->Exchangerates_API_KEY,
        ];

        return $returnData;
    }

}