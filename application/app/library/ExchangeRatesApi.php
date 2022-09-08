<?php
declare(strict_types=1);

namespace xchange;

class ExchangeRatesApi
{
    private const BASE_URL = "https://api.apilayer.com/exchangerates_data/";

    public function getAll(): array
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => self::BASE_URL. "latest?symbols=symbols&base=base",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: text/plain",
            "apikey: FkUObzgA2TV8m62AmTs95zjBW2yhsxDm"
          ),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

        return $response;
    }
}