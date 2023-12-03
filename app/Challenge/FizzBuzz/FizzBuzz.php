<?php

declare(strict_types=1);

namespace App\Challenge\FizzBuzz;

final class FizzBuzz
{
    public function __construct(
        private readonly Settings $fizzBuzzSettings,
    ) {
    }

    public function generateToNumber(int $number): array
    {
        $numbers = range(0, $number - 1); // Subtract one since the method name does not contain include
        $numbers = array_map([$this, 'getWorkForNumber'], $numbers);
        return $numbers;
    }

    private function getWorkForNumber(int $number): string
    {
        $isThree = 0 === $number % $this->fizzBuzzSettings->fizzNumber;
        $isFive = 0 === $number % $this->fizzBuzzSettings->buzzNumber;
        return match(true) {
            ($isThree && $isFive) => $this->fizzBuzzSettings->fizzWord . $this->fizzBuzzSettings->buzzWord,
            $isThree => $this->fizzBuzzSettings->fizzWord,
            $isFive => $this->fizzBuzzSettings->buzzWord,
            default => $this->fizzBuzzSettings->defaultWord,
        };
    }
}
