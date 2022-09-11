<?php

namespace library;

use Exception;
use Phalcon\Di;

class EnvHelper
{
    /**
     * @throws Exception
     */
    public function getApiKey(): string
    {
        $config = Di::getDefault()->getShared('config');
        $myApikey = $config->application->ExchangeRateApikey;
        if (!$myApikey) {
            throw new Exception('Not Acceptable - API KEY NOT FOUND');
        }
        return $myApikey;
    }
}