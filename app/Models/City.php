<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property CityParcel[] $cityParcels
 * @property ResidentCity[] $residentCities
 * @property CompanyCityParcel[] $companyCityParcels
 */
class City extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at', 'name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cityParcels()
    {
        return $this->hasMany(\App\Models\CityParcel::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function residentCities()
    {
        return $this->hasMany(\App\Models\ResidentCity::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function companyCityParcels()
    {
        return $this->hasMany(\App\Models\CompanyCityParcel::class);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
