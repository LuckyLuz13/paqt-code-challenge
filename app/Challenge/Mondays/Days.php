<?php

declare(strict_types=1);

namespace App\Challenge\Mondays;

enum Days: string
{
    case MONDAY = 'monday';
    case TUESDAY = 'tuesday';
    case WEDNESDAY = 'wednesday';
    case THURSDAY = 'thursday';
    case FRIDAY = 'friday';
    case SATURDAY = 'saturday';
    case SUNDAY = 'sunday';

    public function isMatchingDay(\DateTimeInterface $dateTime): bool
    {
        return strtolower($dateTime->format('l')) === $this->value;
    }
}
