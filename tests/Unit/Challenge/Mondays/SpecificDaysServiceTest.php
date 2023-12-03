<?php

declare(strict_types=1);

namespace Tests\Unit\Challenge\Mondays;

use App\Challenge\Mondays\Days;
use App\Challenge\Mondays\SpecificDaysService;
use PHPUnit\Framework\TestCase;

final class SpecificDaysServiceTest extends TestCase
{
    private SpecificDaysService $subject;

    protected function setUp(): void
    {
        $this->subject = new SpecificDaysService(
            Days::MONDAY,
        );
    }

    /** @dataProvider provideTestGetDaysInBetweenFullWeeks
     */
    public function testGetDaysInBetweenFullWeeks(
        \DateTimeInterface $startDate,
        \DateTimeInterface $endDate,
        Days $day,
        int $countDays,
    ): void {
        $actual = $this->subject->getDaysInBetweenFullWeeks(
            $startDate,
            $endDate,
            $day,
        );
        $this->assertCount($countDays, $actual);
    }

    public static function provideTestGetDaysInBetweenFullWeeks(): array
    {
        return [
            'looking for Monday in last days of nov 2023' => [
                new \DateTimeImmutable('2023-11-27'),
                new \DateTimeImmutable('2023-11-27 +7 days'),
                Days::MONDAY,
                1,
            ],

            'looking for Tuesday in last days of nov 2023' => [
                new \DateTimeImmutable('2023-11-27'),
                new \DateTimeImmutable('2023-11-27 +7 days'),
                Days::TUESDAY,
                1,
            ],

            'looking for Sunday in last days of nov 2023' => [
                new \DateTimeImmutable('2023-11-27'),
                new \DateTimeImmutable('2023-11-27 +7 days'),
                Days::SUNDAY,
                1,
            ],

            'looking for Monday without a full week' => [
                new \DateTimeImmutable('2023-11-27'),
                new \DateTimeImmutable('2023-11-27 +5 days'),
                Days::MONDAY,
                0,
            ],

            'looking for Sunday without a full week' => [
                new \DateTimeImmutable('2023-11-27'),
                new \DateTimeImmutable('2023-11-27 +5days'),
                Days::SUNDAY,
                0,
            ],

            'looking for Monday with more than a week' => [
                new \DateTimeImmutable('2023-11-27'),
                new \DateTimeImmutable('2024-11-27'),
                Days::MONDAY,
                52,
            ],

            'looking for Monday with more than a week and a day some' => [
                new \DateTimeImmutable('2023-11-27'),
                new \DateTimeImmutable('2024-11-27 +1 days'),
                Days::MONDAY,
                52,
            ],

            'looking for Monday with more than a week and then some' => [
                new \DateTimeImmutable('2023-11-27'),
                new \DateTimeImmutable('2024-11-27 +5 days'),
                Days::MONDAY,
                53,
            ],
        ];
    }
}
