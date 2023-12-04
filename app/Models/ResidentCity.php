<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $resident_id
 * @property integer $city_id
 * @property string $created_at
 * @property string $updated_at
 * @property City $city
 * @property Resident $resident
 */
class ResidentCity extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['resident_id', 'city_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function resident()
    {
        return $this->belongsTo('App\Models\Resident');
    }
}
