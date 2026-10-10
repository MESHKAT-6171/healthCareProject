<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assessment extends Model
{
    protected $fillable = [
        'user_id',
        'age',
        'bmi',
        'diet_type',
        'sun_exposure',
        'latitude_region',
        'has_bone_pain',
        'has_fatigue',
        'has_muscle_weakness',
        'risk_level',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
