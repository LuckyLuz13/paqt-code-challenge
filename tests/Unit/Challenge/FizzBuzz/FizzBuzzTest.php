<?php

declare(strict_types=1);

namespace Tests\Unit\Challenge\FizzBuzz;

use App\Challenge\FizzBuzz\FizzBuzz;
use App\Challenge\FizzBuzz\Settings;
use PHPUnit\Framework\TestCase;

final class FizzBuzzTest extends TestCase
{
    private FizzBuzz $subject;

    protected function setUp(): void
    {
        $this->subject = new FizzBuzz(
            new Settings('Fizz', 3, 'Buzz', 5, ''),
        );
    }

    public function testGenerateToNumber(): void
    {
        $expected = [
            0 => 'FizzBuzz',
            1 => '',
            2 => '',
            3 => 'Fizz',
            4 => '',
            5 => 'Buzz',
            6 => 'Fizz',
            7 => '',
            8 => '',
            9 => 'Fizz',
            10 => 'Buzz',
            11 => '',
            12 => 'Fizz',
            13 => '',
            14 => '',
            15 => 'FizzBuzz',
            16 => '',
            17 => '',
            18 => 'Fizz',
            19 => '',
            20 => 'Buzz',
            21 => 'Fizz',
            22 => '',
            23 => '',
            24 => 'Fizz',
            25 => 'Buzz',
            26 => '',
            27 => 'Fizz',
            28 => '',
            29 => '',
        ];
        $actual = $this->subject->generateToNumber(30);
        $this->assertSame($expected, $actual);

        // We can easily test multiples of repeating patterns
        $double = $this->subject->generateToNumber(60);
        $this->assertSame(array_merge($expected, $expected), $double);
    }

    public function testWithDifferentSettings(): void
    {
        $subject = new FizzBuzz(
            new Settings('Foo', 2, 'Bar', 7, 'Pun'),
        );

        $expected = [
            0 => 'FooBar',
            1 => 'Pun',
            2 => 'Foo',
            3 => 'Pun',
            4 => 'Foo',
            5 => 'Pun',
            6 => 'Foo',
            7 => 'Bar',
            8 => 'Foo',
            9 => 'Pun',
            10 => 'Foo',
            11 => 'Pun',
            12 => 'Foo',
            13 => 'Pun',
            14 => 'FooBar',
            15 => 'Pun',
            16 => 'Foo',
            17 => 'Pun',
            18 => 'Foo',
            19 => 'Pun',
            20 => 'Foo',
            21 => 'Bar',
            22 => 'Foo',
            23 => 'Pun',
            24 => 'Foo',
            25 => 'Pun',
            26 => 'Foo',
            27 => 'Pun',
            28 => 'FooBar',
            29 => 'Pun',
            30 => 'Foo',
            31 => 'Pun',
            32 => 'Foo',
            33 => 'Pun',
            34 => 'Foo',
            35 => 'Bar',
            36 => 'Foo',
            37 => 'Pun',
            38 => 'Foo',
            39 => 'Pun',
            40 => 'Foo',
            41 => 'Pun',
        ];
        $actual = $subject->generateToNumber(42);
        $this->assertSame($expected, $actual);
    }
}
