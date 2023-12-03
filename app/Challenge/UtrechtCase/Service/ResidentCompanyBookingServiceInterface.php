<?php

declare(strict_types=1);

namespace App\Challenge\UtrechtCase\Service;

interface ResidentCompanyBookingServiceInterface
{
    public function bookForResident(
        int $residentId,
    ): array;

    public function bookForResidentAtCompany(
        int $residentId,
        int $companyId,
    ): array;

    public function listBookingsForResident(
        int $companyId,
        int $limit,
        int $offset,
    ): array;

    public function listBookingForCompany(
        int $companyId,
        int $limit,
        int $offset,
    ): array;
}
