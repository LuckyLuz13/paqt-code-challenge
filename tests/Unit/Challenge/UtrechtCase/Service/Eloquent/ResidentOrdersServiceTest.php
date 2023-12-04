<?php

declare(strict_types=1);

namespace Tests\Unit\Challenge\UtrechtCase\Service\Eloquent;

use App\Challenge\UtrechtCase\Service\Eloquent\ResidentOrdersService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Unit\Challenge\UtrechtCase\CitySetupTrait;
use Tests\Unit\Challenge\UtrechtCase\CompanySetupTrait;
use Tests\Unit\Challenge\UtrechtCase\ResidentSetupTrait;

final class ResidentOrdersServiceTest extends \Tests\TestCase
{
    use RefreshDatabase, CitySetupTrait, CompanySetupTrait, ResidentSetupTrait;

    private ResidentOrdersService $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->refreshDatabase();

        $this->subject = new ResidentOrdersService();
    }

    public function testResetOrders(): void
    {
        $now = new \DateTimeImmutable('now');
        $nrUpdatedRows = $this->subject->resetOrders($now);
        $this->assertSame(0, $nrUpdatedRows);

        $resident = $this->createResident('Foo Bar');
        $residentOrder = $this->registerOrderForResident($resident);

        $nrUpdatedRows = $this->subject->resetOrders($now->modify('+1 year'));
        $this->assertSame(1, $nrUpdatedRows);

        $residentOrderArray = $residentOrder->refresh()->toArray();
        $this->assertEquals(
            $now->modify('+2 years')->setTime(0, 0, 0, 0),
            (new \DateTimeImmutable($residentOrderArray['valid_till']))->setTime(0, 0, 0, 0),
        );
        $this->assertSame($residentOrderArray['reset_date'], $residentOrderArray['valid_till']);
    }

    public function testHasResidentValidOrder(): void
    {
        $resident = $this->createResident('Foo Bar');

        $this->assertFalse($this->subject->hasResidentValidOrder($resident->getId()));

        $resident = $this->createResident('Foo Bar');
        $this->registerOrderForResident($resident);

        $this->assertTrue($this->subject->hasResidentValidOrder($resident->getId()));
    }
}
