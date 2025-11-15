<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient query()
 * @mixin \Eloquent
 */
class Patient extends Model
{
    protected $fillable = [
        'id',
        'full_name',
        'born_date'
    ];

    public function medicalProfile () {
        return $this->hasOne(MedicalProfile::class);
    }

    public function appointment () {
        return $this->hasMany(Appointment::class);
    } 
}
