<?php

declare(strict_types=1);

namespace Tests\Unit\Challenge\UtrechtCase;

use App\Models\City;

trait CitySetupTrait
{
    public function createCity(string $name): City
    {
        $city = new City([
            'name' => $name,
        ]);
        $city->save();
        return $city;
    }
}
