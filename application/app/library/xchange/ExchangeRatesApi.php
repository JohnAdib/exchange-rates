<?php

declare(strict_types=1);

namespace library\xchange;

use Exception;

class ExchangeRatesApi extends AbstractExchangeApi
{
    private const BASE_URL = "https://api.apilayer.com/exchangerates_data/";

    private function targetUrl(): string
    {
        $targetUrl = self::BASE_URL . "latest";
        $targetUrl .= "?" . "base=" . $this->getBase();
        $targetUrl .= "&" . "symbols=" . $this->getSymbols();
        return $targetUrl;
    }

    /**
     * @throws Exception
     */
    public function fetch(): array
    {
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            [
                CURLOPT_URL        => $this->targetUrl(),
                CURLOPT_HTTPHEADER =>
                [
                    "Content-Type: text/plain",
                    "apikey: " . $this->getApiKey()
                ],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => "",
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => "GET"
            ]
        );
        $this->setResponse(curl_exec($curl));
        $this->setResponseCode(curl_getinfo($curl, CURLINFO_HTTP_CODE));
        curl_close($curl);
        return $this->getResponseJson();
    }
}