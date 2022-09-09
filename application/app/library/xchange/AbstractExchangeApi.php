<?php

declare(strict_types=1);

namespace xchange;

abstract class AbstractExchangeApi
{
    protected string $apiKey;
    protected string $response;
    protected int $responseCode;

    public function __construct(string $apikey)
    {
        $this->apiKey = $apikey;
    }

    public function response()
    {
        return $this->response;
    }

    public function responseCode()
    {
        return $this->responseCode;
    }

    public function json(): array
    {
        if (!isset($this->response)) {
            return [];
        }

        $json = json_decode($this->response, true);
        if (is_array($json)) {
            return $json;
        }

        return [];
    }

    abstract public function fetch(string $base, string $symbols): void;
}