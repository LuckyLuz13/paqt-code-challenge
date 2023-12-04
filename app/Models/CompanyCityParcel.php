<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $city_parcel_id
 * @property integer $company_id
 * @property string $created_at
 * @property string $updated_at
 * @property CityParcel $cityParcel
 * @property Company $company
 */
class CompanyCityParcel extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['city_parcel_id', 'company_id', 'created_at', 'updated_at'];

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
    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }
}
