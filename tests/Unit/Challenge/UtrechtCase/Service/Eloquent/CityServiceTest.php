<?php

declare(strict_types=1);

namespace Tests\Unit\Challenge\UtrechtCase\Service\Eloquent;

use App\Challenge\UtrechtCase\Service\Eloquent\CityService;
use App\Models\City;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Unit\Challenge\UtrechtCase\CitySetupTrait;
use Tests\Unit\Challenge\UtrechtCase\CompanySetupTrait;

final class CityServiceTest extends \Tests\TestCase
{
    use RefreshDatabase, CitySetupTrait, CompanySetupTrait;

    private City $cityOfUtrecht;
    private Company $companyInUtrecht;
    private CityService $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->refreshDatabase();

        $this->cityOfUtrecht = $this->createCity('Utrecht');
        $this->companyInUtrecht = $this->createCompany('PAQT');
        $this->registerCompanyInCity($this->companyInUtrecht, $this->cityOfUtrecht);

        $this->subject = new CityService();
    }

    public function testListCities(): void
    {
        $result = $this->subject->listCities(100, 0);
        $this->assertCount(1, $result);
        $this->assertEquals([$this->cityOfUtrecht->toArray()], $result->toArray());
    }

    public function testListCompaniesForCity(): void
    {
        $result = $this->subject->listCompaniesForCity($this->cityOfUtrecht->getName(), 100, 0);
        $this->assertCount(1, $result);
        $this->assertEquals([$this->companyInUtrecht->toArray()], $result->toArray());
    }
}
