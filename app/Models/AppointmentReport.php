<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentReport extends Model
{
    protected $fillable = [
        'id',
        'appointment_id',
        'medical_profile_id',
        'teeth',
        'description'
    ];

    public function appointment () {
        return $this->belongsTo(Appointment::class);
    }

    public function medicalProfile () {
        return $this->belongsTo(MedicalProfile::class);
    }
}
