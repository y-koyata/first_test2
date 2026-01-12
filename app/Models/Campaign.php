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
        'document_request_deadline',
        'postal_application_deadline',
        'payment_deadline',
        'confirmation_delivery_date',
        'survey_definition',
        'status',
        'template_file',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'application_start_at' => 'datetime',
        'application_end_at' => 'datetime',
        'document_request_deadline' => 'date',
        'postal_application_deadline' => 'date',
        'payment_deadline' => 'date',
        'confirmation_delivery_date' => 'date',
        'survey_definition' => 'array',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
