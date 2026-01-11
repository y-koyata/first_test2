<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancellationLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'email',
        'canceled_at',
    ];

    protected $casts = [
        'canceled_at' => 'datetime',
    ];
}
