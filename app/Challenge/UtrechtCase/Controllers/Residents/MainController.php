<?php

declare(strict_types=1);

namespace App\Challenge\UtrechtCase\Controllers\Residents;

use App\Challenge\UtrechtCase\Controllers\CanListInterface;
use App\Challenge\UtrechtCase\Service\ResidentOrdersServiceInterface;
use App\Challenge\UtrechtCase\Service\ResidentsServiceInterface;
use DateTimeInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;

final class MainController extends BaseController implements CanListInterface
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(
        private readonly ResidentsServiceInterface $residentsService,
        private readonly ResidentOrdersServiceInterface $residentOrdersService,
    ) {
    }

    public function list(Request $request): Collection
    {
        return $this->residentsService->listResidents(
            $request->get('limit'),
            $request->get('offset'),
        );
    }

    /**
     * Not publicly available from the API. Would be used from cron/CLI from App\Console\Kernel.
     */
    public function resetOrders(DateTimeInterface $resetDate): int
    {
        return $this->residentOrdersService->resetOrders($resetDate);
    }
}
