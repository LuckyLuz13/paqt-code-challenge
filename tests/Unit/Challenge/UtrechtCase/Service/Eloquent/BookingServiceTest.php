<?php

declare(strict_types=1);

namespace Tests\Unit\Challenge\UtrechtCase\Service\Eloquent;

use App\Challenge\UtrechtCase\Service\Eloquent\BookingService;
use App\Models\City;
use App\Models\Company;
use App\Models\Resident;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Unit\Challenge\UtrechtCase\CitySetupTrait;
use Tests\Unit\Challenge\UtrechtCase\CompanySetupTrait;
use Tests\Unit\Challenge\UtrechtCase\ResidentSetupTrait;

final class BookingServiceTest extends \Tests\TestCase
{
    use RefreshDatabase, CitySetupTrait, CompanySetupTrait, ResidentSetupTrait;

    private City $cityOfUtrecht;
    private Resident $residentInUtrecht;
    private Company $companyInUtrecht;
    private BookingService $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->refreshDatabase();

        $this->cityOfUtrecht = $this->createCity('Utrecht');
        $this->residentInUtrecht = $this->createResident('Foo Bar');
        $this->companyInUtrecht = $this->createCompany('PAQT');

        $this->subject = new BookingService();
    }

    public function testBookForResidentFailsWhenResidentIsNotRegisteredInCity(): void
    {
        $this->expectMissingModel(\App\Models\ResidentCityParcel::class);
        $this->subject->bookForResidentId($this->residentInUtrecht->getId());
    }

    public function testBookForResidentFailsWhenParcelHasNoCompany(): void
    {
        $this->registerResidentInCity($this->residentInUtrecht, $this->cityOfUtrecht);

        $this->expectMissingModel(\App\Models\CompanyCityParcel::class);
        $this->subject->bookForResidentId($this->residentInUtrecht->getId());
    }

    public function testBookForResidentFailsWhenResidentHasNoOrder(): void
    {
        $this->registerResidentInCity($this->residentInUtrecht, $this->cityOfUtrecht);
        $this->registerCompanyInCity($this->companyInUtrecht, $this->cityOfUtrecht);

        $this->expectMissingModel(\App\Models\ResidentOrder::class);
        $this->subject->bookForResidentId($this->residentInUtrecht->getId());
    }

    public function testBookForResidentSucceeds(): void
    {
        $this->registerResidentInCity($this->residentInUtrecht, $this->cityOfUtrecht);
        $this->registerCompanyInCity($this->companyInUtrecht, $this->cityOfUtrecht);
        $this->registerOrderForResident($this->residentInUtrecht);

        $result = $this->subject->bookForResidentId($this->residentInUtrecht->getId());
        $this->assertEquals($this->residentInUtrecht->toArray(), $result->resident()->firstOrFail()->toArray());
        $this->assertEquals($this->companyInUtrecht->toArray(), $result->company()->firstOrFail()->toArray());

        $listing = $this->subject->listBookingsForResident($this->residentInUtrecht->getId(), 100, 0);
        $this->assertCount(1, $listing);
        $this->assertEquals($result->toArray(), $listing->firstOrFail()->toArray());
    }

    public function testListBookingForCompanyNoResults(): void
    {
        $result = $this->subject->listBookingForCompany($this->companyInUtrecht->getId(), 100, 0);
        $this->assertCount(0, $result); // Since we didn't book anything yet
    }

    public function testListBookingForCompany(): void
    {
        $this->registerResidentInCity($this->residentInUtrecht, $this->cityOfUtrecht);
        $this->registerCompanyInCity($this->companyInUtrecht, $this->cityOfUtrecht);
        $this->registerOrderForResident($this->residentInUtrecht);

        $booking = $this->subject->bookForResidentId($this->residentInUtrecht->getId());
        $result = $this->subject->listBookingForCompany($this->companyInUtrecht->getId(), 100, 0);
        $this->assertCount(1, $result);
        $this->assertEquals($booking->toArray(), $result->firstOrFail()->toArray());

        $anotherBooking = $this->subject->bookForResidentId($this->residentInUtrecht->getId());
        $result = $this->subject->listBookingForCompany($this->companyInUtrecht->getId(), 100, 0);
        $this->assertCount(2, $result);
        $this->assertEquals([
                $booking->toArray(),
                $anotherBooking->toArray(),
            ],
            $result->toArray()
        );
    }

    private function expectMissingModel(string $class): void
    {
        $this->expectExceptionObject(
            new ModelNotFoundException(sprintf('No query results for model [%s].', $class))
        );
    }
}
