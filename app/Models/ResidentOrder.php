<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $resident_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $budget
 * @property string $valid_till
 * @property string $reset_date
 * @property string $deactivated_date
 * @property ResidentCompanyBooking[] $residentCompanyBookings
 * @property Resident $resident
 */
class ResidentOrder extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['resident_id', 'created_at', 'updated_at', 'budget', 'valid_till', 'reset_date', 'deactivated_date'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function residentCompanyBookings()
    {
        return $this->hasMany(\App\Models\ResidentCompanyBooking::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function resident()
    {
        return $this->belongsTo(\App\Models\Resident::class);
    }

    public function getId(): int
    {
        return $this->id;
    }
}
