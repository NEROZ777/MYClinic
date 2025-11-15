<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientChronicDisease extends Model
{
    protected $fillable = [
        'id',
        'medical_profile_id',
        'chronic_disease_id',
        'suffer'
    ];

    public function chronicDisease () {
        return $this->belongsTo(ChronicDisease::class);
    }

    public function medicalProfile () {
        return $this->belongsTo(MedicalProfile::class);
    }
}
