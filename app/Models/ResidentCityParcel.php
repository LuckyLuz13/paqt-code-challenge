<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $resident_id
 * @property integer $city_parcel_id
 * @property string $created_at
 * @property string $updated_at
 * @property CityParcel $cityParcel
 * @property Resident $resident
 */
class ResidentCityParcel extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['resident_id', 'city_parcel_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cityParcel()
    {
        return $this->belongsTo(\App\Models\CityParcel::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function resident()
    {
        return $this->belongsTo(\App\Models\Resident::class);
    }
}
