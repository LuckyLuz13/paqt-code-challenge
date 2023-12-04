<?php

declare(strict_types=1);

namespace App\Challenge\UtrechtCase\Service;

use Illuminate\Support\Collection;

interface ResidentsServiceInterface
{
    public function listResidents(int $limit, int $offset): Collection;

    public function listResidentsForCity(string $city, int $limit, int $offset): Collection;
}
