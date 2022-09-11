<?php

declare(strict_types=1);

namespace Tests\Unit;

use library\xchange\Symbols;

class SymbolsTest extends AbstractUnitTest
{
    const SELECTED_SYMBOLS = [
        'USD', 'EUR', 'GBP', 'CHF', 'CAD', 'AUD',
        'JPY', 'CNY', 'RUB', 'IRR', 'AED', 'TRY', 'IQD', 'INR',
    ];

    public function testAllSymbols(): void
    {
        $allSymbols = Symbols::getAll();

        $this->assertIsArray($allSymbols);
        $this->assertArrayHasKey('USD', $allSymbols);
    }

    public function testTestCase(): void
    {
        $mySymbols = Symbols::getFiltered(self::SELECTED_SYMBOLS);

        $this->assertIsArray($mySymbols);
    }
}