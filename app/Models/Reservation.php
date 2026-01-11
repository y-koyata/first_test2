<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'email',
        'name',
        'name_kana',
        'gender',
        'birth_date',
        'zip_code',
        'address',
        'tel',
        'mtb_experience',
        'club_name',
        'club_base',
        'club_role',
        'car_model',
        'car_year',
        'car_color',
        'car_color_other',
        'car_registration_no',
        'companion_adult_count',
        'companion_child_count',
        'additional_parking_count',
        'transfer_date',
        'application_date',
        'total_amount',
        'status',
        'email_verified_at',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'transfer_date' => 'date',
        'application_date' => 'date',
        'email_verified_at' => 'datetime',
    ];
}
