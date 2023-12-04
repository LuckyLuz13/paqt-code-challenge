<?php

declare(strict_types=1);

namespace App\Challenge\UtrechtCase\Service;

use Illuminate\Support\Collection;

interface CompaniesServiceInterface
{
    public function listCompanies(int $limit, int $offset): Collection;
}
