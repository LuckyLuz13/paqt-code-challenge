<?php

declare(strict_types=1);

namespace App\Challenge\UtrechtCase\Service\Eloquent;

use App\Challenge\UtrechtCase\Service\BookingServiceInterface;
use App\Models\Company;
use App\Models\Resident;
use App\Models\ResidentCompanyBooking;
use App\Models\ResidentOrder;
use Illuminate\Support\Collection;

final class BookingService implements BookingServiceInterface
{
    public function bookForResidentId(
        int $residentId
    ): ResidentCompanyBooking {
        /** @var Resident $resident */
        $resident = Resident::findOrFail($residentId);
        return $this->bookForResident($resident);
    }

    public function bookForResident(
        Resident $resident,
    ): ResidentCompanyBooking {
        /** @var Company $company */
        $company = $resident->residentCityParcels()->latest()->firstOrFail()
            ->cityParcel()->firstOrFail()
            ->companyCityParcels()->firstOrFail()
            ->company()->firstOrFail();

        /** @var ResidentOrder $residentOrder */
        $residentOrder = $resident->residentOrders()->latest()->firstOrFail();

        return $this->bookForResidentAtCompanyWithOrder(
            $resident,
            $company,
            $residentOrder,
            new \DateTimeImmutable('now'),
        );
    }

    public function bookForResidentAtCompanyWithOrder(
        Resident $resident,
        Company $company,
        ResidentOrder $residentOrder,
        \DateTimeInterface $when,
    ): ResidentCompanyBooking {
        $booking = new ResidentCompanyBooking([
            'resident_id' => $resident->getId(),
            'company_id' => $company->getId(),
            'resident_order_id' => $residentOrder->getId(),
            'booking_datetime' => $when,
        ]);
        $booking->save();
        $booking->refresh();
        return $booking;
    }

    public function listBookingsForResident(
        int $residentId,
        int $limit,
        int $offset,
    ): Collection {
        /** @var Resident $resident */
        $resident = Resident::where(['id' => $residentId])->firstOrFail();
        return $resident->residentCompanyBookings()->get();
    }

    public function listBookingForCompany(
        int $companyId,
        int $limit,
        int $offset,
    ): Collection {
        /** @var Company $company */
        $company = Company::where(['id' => $companyId])->get()->firstOrFail();
        return $company->residentCompanyBookings()->get();
    }
}
