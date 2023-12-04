<?php

declare(strict_types=1);

namespace Tests\Unit\Challenge\UtrechtCase;

use App\Models\City;
use App\Models\CityParcel;
use App\Models\Company;
use App\Models\CompanyCityParcel;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait CompanySetupTrait
{
    public function createCompany(string $name): Company
    {
        $company = new Company([
            'name' => $name,
        ]);
        $company->save();
        return $company;
    }

    public function registerCompanyInCity(Company $company, City $city): void
    {
        try {
            $cityParcel = CityParcel::where(['city_id' => $city->getId()])->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            $cityParcel = new CityParcel([
                'city_id' => $city->getId(),
            ]);
            $cityParcel->save();
        }

        $companyCityParcel = new CompanyCityParcel([
            'city_parcel_id' => $cityParcel->getId(),
            'company_id' => $company->getId(),
        ]);
        $companyCityParcel->save();
    }
}
