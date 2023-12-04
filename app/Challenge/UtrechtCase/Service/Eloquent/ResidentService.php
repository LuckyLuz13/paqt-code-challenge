<?php

declare(strict_types=1);

namespace App\Challenge\UtrechtCase\Service\Eloquent;

use App\Challenge\UtrechtCase\Service\ResidentsServiceInterface;
use App\Models\Resident;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class ResidentService implements ResidentsServiceInterface
{
    public function listResidents(
        int $limit,
        int $offset,
    ): Collection {
        return Resident::where([])->limit($limit, $offset)->get();
    }

    public function listResidentsForCity(
        string $city,
        int $limit,
        int $offset,
    ): Collection {
        $builder = DB::table('residents')
            ->select('residents.*')
            ->join('resident_city_parcels', 'resident_city_parcels.resident_id', '=', 'residents.id')
            ->join('city_parcels', 'resident_city_parcels.city_parcel_id', '=', 'city_parcels.id')
            ->join('cities', 'city_parcels.city_id', '=', 'cities.id')
            ->where('cities.name', '=', $city)
            ->limit($limit)
            ->offset($offset);

        return new Collection(
            array_map(
                fn (\stdClass $company) => (new Resident())->fill((array) $company),
                $builder->get()->toArray(),
            )
        );
    }
}
