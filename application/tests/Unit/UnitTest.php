<?php

declare(strict_types=1);

namespace Tests\Unit;

class UnitTest extends AbstractUnitTest
{
    public function testTestCase(): void
    {
        $this->assertEquals(
            "Test1",
            "Test1",
            "This will pass"
        );

        $this->assertEquals(
            "MrAdib",
            "MrAdib",
            "This will pass"
        );
    }
}