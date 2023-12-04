<?php

declare(strict_types=1);

namespace App\Challenge\UtrechtCase\Controllers\Cities;

use App\Challenge\UtrechtCase\Controllers\CanListInterface;
use App\Challenge\UtrechtCase\Service\CompaniesServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;

final class CompaniesController extends BaseController implements CanListInterface
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(
        private readonly CompaniesServiceInterface $companiesService,
    ) {
    }

    public function list(Request $request): Collection
    {
        return $this->companiesService->listCompanies(
            $request->get('limit'),
            $request->get('offset'),
        );
    }
}
