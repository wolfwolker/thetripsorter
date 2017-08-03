<?php

namespace TripSorter\Transport;

use PHPUnit\Framework\TestCase;

class BusCardTest extends TestCase
{
    public function testGetRequiredFields()
    {
        self::assertEquals(['name'], BusCard::getRequiredFields());
    }

    public function testGetDescription()
    {
        $name = strval(rand());
        $origin = strval(rand());
        $destiny = strval(rand());

        $actual = (new BusCard($origin, $destiny, ['name' => $name]))->getRouteDescription();

        self::assertContains($name, $actual);
        self::assertContains($origin, $actual);
        self::assertContains($destiny, $actual);
    }
}
