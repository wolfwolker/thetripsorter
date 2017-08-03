<?php

namespace TripSorter;

use PHPUnit\Framework\TestCase;

class TripSorterTest extends TestCase
{
    public function testWrongTransport()
    {
        $this->expectException('\InvalidArgumentException');

        (new TripSorter())->sort([
            ['type' => 'dog', 'origin' => 'a', 'destiny' => 'b']
        ]);
    }

    public function testMissedField()
    {
        $this->expectException('\InvalidArgumentException');

        (new TripSorter())->sort([
            ['type' => 'train', 'destiny' => 'b']
        ]);
    }

    public function testSort()
    {
        $output = (new TripSorter())->sort([
            ['type' => 'taxi', 'destiny' => 'b', 'origin' => 'a'],
            ['type' => 'taxi', 'destiny' => 'e', 'origin' => 'd'],
            ['type' => 'taxi', 'destiny' => 'd', 'origin' => 'c'],
            ['type' => 'taxi', 'destiny' => 'c', 'origin' => 'b'],
        ]);

        self::assertCount(5, $output);
        self::assertContains('a to b', $output[0]);
        self::assertContains('b to c', $output[1]);
        self::assertContains('c to d', $output[2]);
        self::assertContains('d to e', $output[3]);
    }
}
