<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill query()
 * @mixin \Eloquent
 */
class Bill extends Model
{
    protected $fillable = [
        'id',
        'patient_id',
        'cost',
        'paid'
    ];

    public function appointment () {
        return $this->hasMany(Appointment::class);
    }
}
