<?php

declare(strict_types=1);

namespace App\Challenge\FizzBuzz;

final class Settings
{
    public function __construct(
        public readonly string $fizzWord,
        public readonly int $fizzNumber,
        public readonly string $buzzWord,
        public readonly int $buzzNumber,
        public readonly string $defaultWord,
    ) {
    }
}
