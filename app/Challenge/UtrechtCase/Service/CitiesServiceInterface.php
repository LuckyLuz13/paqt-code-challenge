<?php

declare(strict_types=1);

namespace App\Challenge\UtrechtCase\Service;

interface CitiesServiceInterface
{
    public function listCities(int $limit, int $offset): array;

    public function listCompaniesForCity(string $city, int $limit, int $offset): array;
}
