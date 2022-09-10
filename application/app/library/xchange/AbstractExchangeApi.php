<?php

declare(strict_types=1);

namespace xchange;

use Exception;

abstract class AbstractExchangeApi
{
    private string $apiKey;
    private string $base = 'USD';
    private string $symbols = "";
    protected string $response = "";
    protected int $responseCode = -1;

    public function __construct(string $apikey, string $base, array $symbols)
    {
        $this->setApiKey($apikey);
        $this->setBase($base);
        $this->setSymbols($symbols);
    }

    public function setApiKey(string $apikey): void
    {
        $this->apiKey = $apikey;
    }

    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    public function setBase(string $base): void
    {
        if (Symbols::isSymbolExist($base)) {
            $this->base = $base;
        }
    }

    public function getBase(): string
    {
        return $this->base;
    }

    public function setSymbols(array $symbols)
    {
        $mySymbols = [];
        foreach ($symbols as $value) {
            if (Symbols::isSymbolExist($value)) {
                $mySymbols[] = $value;
            }
        }
        $this->symbols = implode(',', $mySymbols);
    }

    public function getSymbols(): ?string
    {
        return $this->symbols;
    }

    /**
     * @throws Exception
     */
    public function getResponseJson(): array
    {
        $json = json_decode($this->response, true);
        if (is_array($json)) {
            return $json;
        }
        $errorMsg = "API response is invalid - Header code " . $this->responseCode;
        throw new Exception($errorMsg);
    }

    abstract public function fetch(): array;
}