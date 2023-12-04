<?php

declare(strict_types=1);

namespace App\Challenge\UtrechtCase\Service\Eloquent;

use App\Challenge\UtrechtCase\Service\CitiesServiceInterface;
use App\Models\City;
use App\Models\Company;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class CityService implements CitiesServiceInterface
{
    public function listCities(
        int $limit,
        int $offset,
    ): Collection {
        return City::where([])->limit($limit)->offset($offset)->get();
    }

    public function listCompaniesForCity(
        string $city,
        int $limit,
        int $offset,
    ): Collection {
        $builder = DB::table('companies')
            ->select('companies.*')
            ->join('company_city_parcels', 'company_city_parcels.company_id', '=', 'companies.id')
            ->join('city_parcels', 'company_city_parcels.city_parcel_id', '=', 'city_parcels.id')
            ->join('cities', 'city_parcels.city_id', '=', 'cities.id')
            ->where('cities.name', '=', $city)
            ->limit($limit)
            ->offset($offset);

        return new Collection(
            array_map(
                fn (\stdClass $company) => (new Company())->fill((array) $company),
                $builder->get()->toArray(),
            )
        );
    }
}
