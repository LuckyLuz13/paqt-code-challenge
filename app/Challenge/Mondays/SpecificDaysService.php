<?php

declare(strict_types=1);

namespace App\Challenge\Mondays;

final class SpecificDaysService
{
    public function __construct(
        private Days $startOfTheWeek,
    ) {
    }

    public function getDaysInBetweenFullWeeks(
        \DateTimeInterface $startDate,
        \DateTimeInterface $endDate,
        Days $day,
    ): array {
        // The challenge did not specify if we have to take into account that $endDate can be greater than $startDate
        $calculationDate = \DateTimeImmutable::createFromInterface($startDate);
        if (!$this->startOfTheWeek->isMatchingDay($calculationDate)) {
            $calculationDate = $calculationDate->modify(sprintf('next %s', $this->startOfTheWeek->value));
        }
        $collectedDays = [];
        while ($calculationDate <= $endDate) {
            $diff = $calculationDate->diff($endDate);
            if (7 <= $diff->days) {
                $collectedDays[] = [
                    'startDate' => $calculationDate,
                    'diff' => $diff,
                    'endDate' => $endDate,
                ];
            }
            $calculationDate = $calculationDate->modify(sprintf('next %s', $day->value));
        }
        return $collectedDays;
    }
}
