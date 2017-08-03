<?php

namespace TripSorter\Transport;

use PHPUnit\Framework\TestCase;

class TaxiCardTest extends TestCase
{
    public function testGetRequiredFields()
    {
        self::assertEquals([], TaxiCard::getRequiredFields());
    }

    public function testGetDescription()
    {
        $origin = strval(rand());
        $destiny = strval(rand());

        $actual = (new TaxiCard($origin, $destiny))->getRouteDescription();

        self::assertContains($origin, $actual);
        self::assertContains($destiny, $actual);
    }
}
