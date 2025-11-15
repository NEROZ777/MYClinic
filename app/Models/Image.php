<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'id',
        'medical_profile_id',
        'image'
    ];

    public function medicalProfile () {
        return $this->belongsTo(MedicalProfile::class);
    }
}
