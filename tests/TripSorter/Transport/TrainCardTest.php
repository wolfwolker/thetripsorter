<?php

namespace TripSorter\Transport;

use PHPUnit\Framework\TestCase;

class TrainCardTest extends TestCase
{
    public function testGetRequiredFields()
    {
        self::assertEquals(['name', 'seat'], TrainCard::getRequiredFields());
    }

    public function testGetDescription()
    {
        $name = strval(rand());
        $seat = strval(rand());
        $origin = strval(rand());
        $destiny = strval(rand());

        $actual = (new TrainCard($origin, $destiny, [
            'name' => $name,
            'seat' => $seat,
        ]))->getRouteDescription();

        self::assertContains($name, $actual);
        self::assertContains($origin, $actual);
        self::assertContains($destiny, $actual);
        self::assertContains($seat, $actual);
    }
}
