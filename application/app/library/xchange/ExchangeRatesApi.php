<?php

declare(strict_types=1);

namespace xchange;

class ExchangeRatesApi extends AbstractExchangeApi
{
    private const BASE_URL = "https://api.apilayer.com/exchangerates_data/";

    public function fetch(): void
    {
        $targetUrl = self::BASE_URL . "latest";
        $targetUrl .= "?" . "base=" . $this->getBase();
        $targetUrl .= "&" . "symbols=" . $this->getSymbolsCsv();

        $curl = curl_init();
        curl_setopt_array(
            $curl,
            [
                CURLOPT_URL        => $targetUrl,
                CURLOPT_HTTPHEADER =>
                [
                    "Content-Type: text/plain",
                    "apikey: " . $this->getApiKey()
                ],
                // CURLOPT_HEADER         => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => "",
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => "GET"
            ]
        );
        $this->response = curl_exec($curl);
        $this->responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);
    }
}