<?php

declare(strict_types=1);

namespace Tests\Unit\Challenge\UtrechtCase\Service\Eloquent;

use App\Challenge\UtrechtCase\Service\Eloquent\ResidentService;
use App\Models\City;
use App\Models\Resident;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Unit\Challenge\UtrechtCase\CitySetupTrait;
use Tests\Unit\Challenge\UtrechtCase\ResidentSetupTrait;

final class ResidentServiceTest extends \Tests\TestCase
{
    use RefreshDatabase, CitySetupTrait, ResidentSetupTrait;

    private City $cityOfUtrecht;
    private Resident $residentInUtrecht;
    private ResidentService $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->refreshDatabase();

        $this->cityOfUtrecht = $this->createCity('Utrecht');
        $this->residentInUtrecht = $this->createResident('Foo Bar');
        $this->registerResidentInCity($this->residentInUtrecht, $this->cityOfUtrecht);

        $this->subject = new ResidentService();
    }

    public function testListResidents(): void
    {
        $result = $this->subject->listResidents(100, 0);
        $this->assertCount(1, $result);
        $this->assertEquals([$this->residentInUtrecht->toArray()], $result->toArray());
    }

    public function testListResidentsForCity(): void
    {
        // To show that we only get the results back from Utrecht
        $anotherCity = $this->createCity('Amersfoort');
        $anotherResident = $this->createResident('Bar Foo');
        $this->registerResidentInCity($anotherResident, $anotherCity);

        $result = $this->subject->listResidentsForCity($this->cityOfUtrecht->getName(), 100, 0);
        $this->assertCount(1, $result);
        $this->assertEquals([$this->residentInUtrecht->toArray()], $result->toArray());
    }
}
