<?php

declare(strict_types=1);

namespace xchange;

use xchange\Symbols;

abstract class AbstractExchangeApi
{
    private string $apiKey;
    private string $base = 'USD';
    private array $symbols = [];
    private string $symbolsCsv = "";
    protected string $response = "";
    protected int $responseCode = -1;

    public function __construct(string $apikey)
    {
        $this->apiKey = $apikey;
    }

    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }

    public function getResponseCode(): ?int
    {
        return $this->responseCode;
    }

    public function getBase(): string
    {
        return $this->base;
    }

    public function setBase(string $base): void
    {
        if (Symbols::isSymbolExist($base)) {
            $this->base = $base;
        }
    }

    public function getSymbols(): ?array
    {
        return $this->symbols;
    }

    public function getSymbolsCsv(): ?string
    {
        return $this->symbolsCsv;
    }

    public function setSymbols(array $symbols)
    {
        $mySymbols = [];
        foreach ($symbols as $value) {
            if (Symbols::isSymbolExist($value)) {
                array_push($mySymbols, $value);
            }
        }
        $this->symbols = $mySymbols;
        $this->symbolsCsv = implode(',', $mySymbols);
    }

    public function getResponseJson(): array
    {
        $json = json_decode($this->response, true);
        if (is_array($json)) {
            return $json;
        }

        $errorMsg = "API response is invalid - Header code " . $this->responseCode;
        throw new \Exception($errorMsg);
    }

    abstract public function fetch(): void;
}