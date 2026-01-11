<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailLog extends Model
{
    protected $guarded = [];

    protected $casts = [
        'headers' => 'array',
    ];
}
