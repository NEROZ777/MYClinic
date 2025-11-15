<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment query()
 * @mixin \Eloquent
 */
class Appointment extends Model
{
    protected $fillable = [
        'id',
        'patient_id',
        'bill_id',
        'date',
        'finished',
        'paid'
    ];

    public function patient () {
        return $this->belongsTo(Patient::class);
    }

    public function appointmentReport () {
        return $this->hasOne(AppointmentReport::class);
    }

    public function bill () {
        return $this->belongsTo(Bill::class);
    }
}
