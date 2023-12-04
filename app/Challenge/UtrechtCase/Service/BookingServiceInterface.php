<?php

declare(strict_types=1);

namespace App\Challenge\UtrechtCase\Service;

use App\Models\Company;
use App\Models\Resident;
use App\Models\ResidentCompanyBooking;
use App\Models\ResidentOrder;
use Illuminate\Support\Collection;

interface BookingServiceInterface
{
    public function bookForResidentId(
        int $residentId,
    ): ResidentCompanyBooking;

    public function bookForResident(
        Resident $resident,
    ): ResidentCompanyBooking;

    public function bookForResidentAtCompanyWithOrder(
        Resident $resident,
        Company $company,
        ResidentOrder $residentOrder,
        \DateTimeInterface $when,
    ): ResidentCompanyBooking;

    public function listBookingsForResident(
        int $residentId,
        int $limit,
        int $offset,
    ): Collection;

    public function listBookingForCompany(
        int $companyId,
        int $limit,
        int $offset,
    ): Collection;
}
