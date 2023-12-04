<?php

declare(strict_types=1);

namespace App\Challenge\UtrechtCase\Controllers\Cities;

use App\Challenge\UtrechtCase\Controllers\CanListInterface;
use App\Challenge\UtrechtCase\Service\CitiesServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;

final class MainController extends BaseController implements CanListInterface
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(
        private CitiesServiceInterface $citiesService,
    ) {
    }

    public function list(Request $request): Collection
    {
        return $this->citiesService->listCities(
            $request->get('limit'),
            $request->get('offset'),
        );
    }
}
