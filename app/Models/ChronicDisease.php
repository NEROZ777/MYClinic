<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChronicDisease newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChronicDisease newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChronicDisease query()
 * @mixin \Eloquent
 */
class ChronicDisease extends Model
{
    protected $fillable = [
        'id',
        'name',
        'class',
        'level'
    ];

    public function patientChronicDisease () {
        return $this->hasMany(PatientChronicDisease::class);
    }
}
