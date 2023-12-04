<?php

declare(strict_types=1);

namespace App\Challenge\UtrechtCase\Service;

use Illuminate\Support\Collection;

interface CitiesServiceInterface
{
    public function listCities(int $limit, int $offset): Collection;

    public function listCompaniesForCity(string $city, int $limit, int $offset): Collection;
}
