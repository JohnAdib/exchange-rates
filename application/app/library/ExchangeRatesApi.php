<?php

declare(strict_types=1);

namespace xchange;

class ExchangeRatesApi
{
    private const BASE_URL = "https://api.apilayer.com/exchangerates_data/";
    private string $API_KEY;

    public function __construct(string $apikey)
    {
        $this->API_KEY = $apikey;
    }

    public function fetch(string $base, string $symbols): ?array
    {
        $targetUrl = self::BASE_URL . "latest?symbols=" . $symbols . "&base=" . $base;

        $curl = curl_init();
        curl_setopt_array(
            $curl,
            [
                CURLOPT_URL => $targetUrl,
                CURLOPT_HTTPHEADER =>
                [
                    "Content-Type: text/plain",
                    "apikey: " . $this->API_KEY
                ],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET"
            ]
        );

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;

        $jsonResult = json_decode($response, true);

        return $jsonResult;
    }
}