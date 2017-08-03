<?php

namespace TripSorter\Transport;

use PHPUnit\Framework\TestCase;

class BaseBoardingCardTest extends TestCase
{
    public function testConstructError()
    {
        $this->expectException('\InvalidArgumentException');

        new DummyCard('$origin', '$destiny');
    }

    public function testGetOriginAndDestiny()
    {
        $origin = strval(rand());
        $destiny = strval(rand());

        $card = new DummyCard($origin, $destiny, ['foo' => 'bar']);

        self::assertEquals($origin, $card->getOrigin());
        self::assertEquals($destiny, $card->getDestiny());
    }
}
