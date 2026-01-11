<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'base_fee',
        'companion_adult_fee',
        'companion_child_fee',
        'additional_parking_fee',
        'event_date',
        'application_start_at',
        'application_end_at',
        'survey_definition',
        'status',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'application_start_at' => 'datetime',
        'application_end_at' => 'datetime',
        'survey_definition' => 'array',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
