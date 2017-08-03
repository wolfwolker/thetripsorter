<?php

namespace TripSorter;

use PHPUnit\Framework\TestCase;
use TripSorter\Transport\DummyCard;

class BoardingCardsStackTest extends TestCase
{
    public function testGetOrderedBoardingCards()
    {
        $unordered = [
            'five' => new DummyCard('e', 'f', ['foo' => 5]),
            'three' => new DummyCard('c', 'd', ['foo' => 3]),
            'one' => new DummyCard('a', 'b', ['foo' => 1]),
            'four' => new DummyCard('d', 'e', ['foo' => 4]),
            'two' => new DummyCard('b', 'c', ['foo' => 2]),
        ];

        $trip = BoardingCardStack::createFromArray(array_values($unordered));

        $ordered = $trip->getOrderedBoardingCards();

        self::assertCount(count($unordered), $ordered);

        self::assertEquals($unordered['one'], $ordered[0]);
        self::assertEquals($unordered['two'], $ordered[1]);
        self::assertEquals($unordered['three'], $ordered[2]);
        self::assertEquals($unordered['four'], $ordered[3]);
        self::assertEquals($unordered['five'], $ordered[4]);
    }

    public function testBrokenRoute()
    {
        $unordered = [
            'five' => new DummyCard('e', 'f', ['foo' => 5]),
            'three' => new DummyCard('c', 'd', ['foo' => 3]),
            'one' => new DummyCard('a', 'b', ['foo' => 1]),
            'four' => new DummyCard('d', 'eeeeeeeeeeeee', ['foo' => 4]),
            'two' => new DummyCard('b', 'c', ['foo' => 2]),
        ];

        $trip = BoardingCardStack::createFromArray(array_values($unordered));

        $this->expectException('\Exception');
        $trip->getOrderedBoardingCards();
    }
}
