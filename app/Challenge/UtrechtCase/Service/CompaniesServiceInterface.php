<?php

declare(strict_types=1);

namespace App\Challenge\UtrechtCase\Service;

interface CompaniesServiceInterface
{
    public function listCompanies(int $limit, int $offset): array;
}
