<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property ResidentCity[] $residentCities
 * @property ResidentCompanyBooking[] $residentCompanyBookings
 * @property ResidentOrder[] $residentOrders
 */
class Resident extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['id', 'created_at', 'updated_at', 'name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function residentCityParcels()
    {
        return $this->hasMany(\App\Models\ResidentCityParcel::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function residentCompanyBookings()
    {
        return $this->hasMany(\App\Models\ResidentCompanyBooking::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function residentOrders()
    {
        return $this->hasMany(\App\Models\ResidentOrder::class);
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
