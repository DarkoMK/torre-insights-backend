<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = "history_log";
    protected $guarded = [];

    protected $casts = [
        'remoter' => 'array',
        'skill' => 'array',
        'compensationrange' => 'array',
        'map' => 'array',
    ];
}
