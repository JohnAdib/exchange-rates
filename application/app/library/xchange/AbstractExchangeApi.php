<?php

declare(strict_types=1);

namespace library\xchange;

use Exception;

abstract class AbstractExchangeApi
{
    private string $apiKey;
    private string $base = 'USD';
    private string $symbols = "";
    private string $response = "";
    private int $responseCode = -1;

    public function __construct(string $apikey, array $symbols, ?string $base = "USD")
    {
        $this->setApiKey($apikey);
        $this->setBase($base);
        $this->setSymbols($symbols);
    }

    protected function setApiKey(string $apikey): void
    {
        $this->apiKey = $apikey;
    }

    protected function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    protected function setBase(?string $base): void
    {
        if ($base && Symbols::isSymbolExist($base)) {
            $this->base = $base;
        }
    }

    protected function getBase(): string
    {
        return $this->base;
    }

    protected function setSymbols(array $symbols): void
    {
        $mySymbols = [];
        foreach ($symbols as $value) {
            if (Symbols::isSymbolExist($value)) {
                $mySymbols[] = $value;
            }
        }
        $this->symbols = implode(',', $mySymbols);
    }

    protected function getSymbols(): string
    {
        return $this->symbols;
    }

    protected function setResponse(string $response): void
    {
        $this->response = $response;
    }

    protected function getResponse(): string
    {
        return $this->response;
    }

    protected function setResponseCode(int $responseCode): void
    {
        $this->responseCode = $responseCode;
    }

    protected function getResponseCode(): int
    {
        return $this->responseCode;
    }

    /**
     * @throws Exception
     */
    protected function getResponseJson(): array
    {
        $json = json_decode($this->getResponse(), true);
        if (is_array($json)) {
            return $json;
        }
        $errorMsg = "API response is invalid - Header code " . $this->getResponseCode();
        throw new Exception($errorMsg);
    }

    abstract public function fetch(): array;
}