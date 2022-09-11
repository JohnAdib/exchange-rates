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
        $myApikey = $config->application->EXCHANGERATES_API_KEY;
        if (!$myApikey) {
            throw new Exception('Not Acceptable - API KEY NOT FOUND');
        }
        return $myApikey;
    }
}