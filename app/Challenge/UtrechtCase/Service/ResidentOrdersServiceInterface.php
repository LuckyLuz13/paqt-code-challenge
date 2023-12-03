<?php

declare(strict_types=1);

namespace App\Challenge\UtrechtCase\Service;

interface ResidentOrdersServiceInterface
{
    public function resetOrders(\DateTimeInterface $resetDate): int;

    public function hasResidentValidOrder(int $residentId): bool;
}
