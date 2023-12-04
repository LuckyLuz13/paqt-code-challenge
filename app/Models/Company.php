<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property ResidentCompanyBooking[] $residentCompanyBookings
 * @property CompanyCityParcel[] $companyCityParcels
 */
class Company extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['id', 'created_at', 'updated_at', 'name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function residentCompanyBookings()
    {
        return $this->hasMany('App\Models\ResidentCompanyBooking');
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

    public function getName(): string
    {
        return $this->name;
    }
}
