<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalProfile query()
 * @mixin \Eloquent
 */
class MedicalProfile extends Model
{
    protected $fillable = [
        'id',
        'patient_id',
    ];

    public function patient () {
        return $this->hasOne(Patient::class);
    }

    public function image () {
        return $this->hasMany(Image::class);
    }

    public function patientChronicDisease () {
        return $this->hasMany(PatientChronicDisease::class);
    }

    public function appointmentReport () {
        return $this->hasMany(AppointmentReport::class);
    }
}
