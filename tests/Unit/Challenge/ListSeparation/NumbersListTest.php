<?php

declare(strict_types=1);

namespace Tests\Unit\Challenge\ListSeparation;

use App\Challenge\ListSeparation\NumbersList;
use PHPUnit\Framework\TestCase;

final class NumbersListTest extends TestCase
{
    private NumbersList $subject;

    protected function setUp(): void
    {
        $this->subject = new NumbersList(...range(1, 10));
    }

    public function testChunkWithSizeThree(): void
    {
        $expected = [
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9],
            [10],
        ];
        $actual = $this->subject->chunkWithSize(3);
        $this->assertSame($expected, $actual);
    }

    public function testChunkWithSizeFive(): void
    {
        $expected = [
            [1, 2, 3, 4, 5],
            [6, 7, 8, 9, 10],
        ];
        $actual = $this->subject->chunkWithSize(5);
        $this->assertSame($expected, $actual);
    }
}
