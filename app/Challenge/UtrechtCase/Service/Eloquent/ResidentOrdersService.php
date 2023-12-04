<?php

declare(strict_types=1);

namespace App\Challenge\UtrechtCase\Service\Eloquent;

use App\Challenge\UtrechtCase\Service\ResidentOrdersServiceInterface;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

final class ResidentOrdersService implements ResidentOrdersServiceInterface
{
    public function resetOrders(\DateTimeInterface $resetDate): int
    {
        $newDate = clone $resetDate;
        $newDate = $newDate->modify('+1 year');
        $values = [
            'reset_date' => $newDate,
            'valid_till' => $newDate,
        ];

        return DB::table('resident_orders')
            ->select([
                new Expression(sprintf('cast(from_unixtime(%d) as date) as givenDate', $resetDate->getTimestamp())),
                new Expression('cast(reset_date as date) as checkDate'),
                'resident_orders.*',
            ])
            ->whereNull('deactivated_date')
            ->where(
                DB::raw('cast(reset_date as date)'),
                '=',
                DB::raw(sprintf('cast(from_unixtime(%d) as date)', $resetDate->getTimestamp())),
            )->update($values);
    }

    public function hasResidentValidOrder(int $residentId): bool
    {
        $builder = DB::table('resident_orders')
            ->where('resident_id', '=', $residentId)
            ->whereNull('deactivated_date')
            ->where('valid_till', '>', new \DateTimeImmutable('now'))
            ->where('reset_date', '>', new \DateTimeImmutable('now'));

        return 0 < $builder->count();
    }
}
