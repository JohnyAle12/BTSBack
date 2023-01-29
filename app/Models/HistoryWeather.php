<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryWeather extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'city',
        'latitude',
        'longitude',
        'humidity',
    ];
}
