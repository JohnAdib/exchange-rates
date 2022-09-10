<?php

declare(strict_types=1);

namespace Tests\Unit;

use xchange\Symbols;

class SymbolsTest extends AbstractUnitTest
{
    const SELECTED_SYMBOLS = [
        'USD', 'EUR', 'GBP', 'CHF', 'CAD', 'AUD',
        'JPY', 'CNY', 'RUB', 'IRR', 'AED', 'TRY', 'IQD', 'INR',
    ];

    public function testAllSymbols(): void
    {
        $allSymboles = Symbols::getAll();

        $this->assertIsArray($allSymboles);
        $this->assertArrayHasKey('USD', $allSymboles);
    }

    public function testTestCase(): void
    {
        $mySymols = Symbols::getFiltered(self::SELECTED_SYMBOLS);

        $this->assertIsArray($mySymols);
    }
}