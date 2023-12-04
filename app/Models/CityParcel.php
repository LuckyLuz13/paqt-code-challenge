<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $city_id
 * @property string $created_at
 * @property string $updated_at
 * @property City $city
 * @property ResidentCityParcel[] $residentCityParcels
 * @property CompanyCityParcel[] $companyCityParcels
 */
class CityParcel extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['city_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function residentCityParcels()
    {
        return $this->hasMany('App\Models\ResidentCityParcel');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function companyCityParcels()
    {
        return $this->hasMany('App\Models\CompanyCityParcel');
    }

    public function getId(): int
    {
        return $this->id;
    }
}
