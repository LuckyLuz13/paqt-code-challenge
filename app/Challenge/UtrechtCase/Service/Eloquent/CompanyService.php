<?php

declare(strict_types=1);

namespace App\Challenge\UtrechtCase\Service\Eloquent;

use App\Challenge\UtrechtCase\Service\CompaniesServiceInterface;
use App\Models\Company;
use Illuminate\Support\Collection;

final class CompanyService implements CompaniesServiceInterface
{
    public function listCompanies(int $limit, int $offset): Collection
    {
        return Company::where([])->limit($limit)->offset($offset)->get();
    }
}
