<?php

declare(strict_types=1);

namespace App\Challenge\UtrechtCase\Controllers\Companies;

use App\Challenge\UtrechtCase\Controllers\CanListInterface;
use App\Challenge\UtrechtCase\Service\ResidentCompanyBookingServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

final class BookingsController extends BaseController implements CanListInterface
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(
        private readonly ResidentCompanyBookingServiceInterface $residentCompanyBookingService,
    ) {
    }

    public function list(Request $request): array
    {
        return $this->residentCompanyBookingService->listBookingForCompany(
            $request->get('company_id'),
            $request->get('limit'),
            $request->get('offset'),
        );
    }
}
