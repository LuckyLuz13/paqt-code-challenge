<?php

declare(strict_types=1);

namespace Tests\Unit\Challenge\UtrechtCase;

use App\Models\City;
use App\Models\CityParcel;
use App\Models\Resident;
use App\Models\ResidentCityParcel;
use App\Models\ResidentOrder;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait ResidentSetupTrait
{
    public function createResident(string $name): Resident
    {
        try {
            $resident = Resident::where(['name' => $name])->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            $resident = new Resident([
                'name' => $name,
            ]);
            $resident->save();
        }
        return $resident;
    }

    public function registerResidentInCity(Resident $resident, City $city): void
    {
        try {
            $cityParcel = CityParcel::where(['city_id' => $city->getId()])->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            $cityParcel = new CityParcel(
                [
                    'city_id' => $city->getId(),
                ]
            );
            $cityParcel->save();
        }

        try {
            $residentCityParcel = ResidentCityParcel::where([
                'city_parcel_id' => $cityParcel->getId(),
                'resident_id' => $resident->getId(),
            ])->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            $residentCityParcel = new ResidentCityParcel(
                [
                    'city_parcel_id' => $cityParcel->getId(),
                    'resident_id' => $resident->getId(),
                ]
            );
            $residentCityParcel->save();
        }
    }

    public function registerOrderForResident(
        Resident $resident,
    ): ResidentOrder {
        $residentOrder = new ResidentOrder([
            'resident_id' => $resident->getId(),
            'budget' => 42,
            'valid_till' => new \DateTimeImmutable('+1 year'),
            'reset_date' => new \DateTimeImmutable('+1 year'),
        ]);
        $residentOrder->save();
        $residentOrder->refresh();
        return $residentOrder;
    }
}
