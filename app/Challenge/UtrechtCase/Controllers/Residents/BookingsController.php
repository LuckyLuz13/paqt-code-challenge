<?php

declare(strict_types=1);

namespace App\Challenge\UtrechtCase\Controllers\Residents;

use App\Challenge\UtrechtCase\Controllers\CanListInterface;
use App\Challenge\UtrechtCase\Service\BookingServiceInterface;
use App\Challenge\UtrechtCase\Service\ResidentOrdersServiceInterface;
use App\Models\ResidentCompanyBooking;
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
        private readonly ResidentOrdersServiceInterface $residentOrdersService,
    ) {
    }

    public function list(Request $request): Collection
    {
        return $this->residentCompanyBookingService->listBookingsForResident(
            $request->get('resident_id'),
            $request->get('limit'),
            $request->get('offset'),
        );
    }

    public function bookForResident(
        Request $request,
    ): ResidentCompanyBooking {
        $residentId = $request->get('resident_id');
        if (!$this->residentOrdersService->hasResidentValidOrder($residentId)) {
            throw new \DomainException('Resident has no valid open order');
        }
        // In this case the service is responsible for figuring out which company to book with
        return $this->residentCompanyBookingService->bookForResidentId($residentId);
    }
}
