<?php

namespace TripSorter\Transport;

use PHPUnit\Framework\TestCase;

class FlightCardTest extends TestCase
{
    public function testGetRequiredFields()
    {
        self::assertEquals(['name', 'seat', 'gate'], FlightCard::getRequiredFields());
    }

    public function testGetDescription()
    {
        $name = strval(rand());
        $seat = strval(rand());
        $gate = strval(rand());
        $origin = strval(rand());
        $destiny = strval(rand());

        $actual = (new FlightCard($origin, $destiny, [
            'name' => $name,
            'seat' => $seat,
            'gate' => $gate,
        ]))->getRouteDescription();

        self::assertContains($name, $actual);
        self::assertContains($origin, $actual);
        self::assertContains($destiny, $actual);
        self::assertContains($seat, $actual);
        self::assertContains($gate, $actual);
        self::assertNotContains('Baggage will we automatically transferred from your last leg.', $actual);

        $actual = (new FlightCard($origin, $destiny, [
            'name' => $name,
            'seat' => $seat,
            'gate' => $gate,
            'baggageTransfer' => true,
        ]))->getRouteDescription();

        self::assertContains('Baggage will we automatically transferred from your last leg.', $actual);
    }
}
