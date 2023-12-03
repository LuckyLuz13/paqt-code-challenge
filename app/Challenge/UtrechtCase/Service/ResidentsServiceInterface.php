<?php

declare(strict_types=1);

namespace App\Challenge\UtrechtCase\Service;

interface ResidentsServiceInterface
{
    public function listResidents(int $limit, int $offset): array;

    public function listResidentsForCity(string $city, int $limit, int $offset): array;
}
