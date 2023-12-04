<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $resident_id
 * @property integer $company_id
 * @property integer $resident_order_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $booking_datetime
 * @property Company $company
 * @property Resident $resident
 * @property ResidentOrder $residentOrder
 */
class ResidentCompanyBooking extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['resident_id', 'company_id', 'resident_order_id', 'created_at', 'updated_at', 'booking_datetime'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function resident()
    {
        return $this->belongsTo('App\Models\Resident');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function residentOrder()
    {
        return $this->belongsTo('App\Models\ResidentOrder');
    }
}
