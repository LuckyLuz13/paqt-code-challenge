<?php

declare(strict_types=1);

namespace App\Challenge\ListSeparation;

final class NumbersList
{
    private array $numbers;

    public function __construct(int ...$numbers)
    {
        $this->numbers = $numbers;
    }

    public function chunkWithSize(int $number): array
    {
        return array_chunk($this->numbers, $number);
    }
}
