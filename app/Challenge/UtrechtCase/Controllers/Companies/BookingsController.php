<?php

declare(strict_types=1);

namespace App\Challenge\UtrechtCase\Controllers\Companies;

use App\Challenge\UtrechtCase\Controllers\CanListInterface;
use App\Challenge\UtrechtCase\Service\BookingServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;

final class BookingsController extends BaseController implements CanListInterface
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(
        private readonly BookingServiceInterface $residentCompanyBookingService,
    ) {
    }

    public function list(Request $request): Collection
    {
        return $this->residentCompanyBookingService->listBookingForCompany(
            $request->get('company_id'),
            $request->get('limit'),
            $request->get('offset'),
        );
    }
}
