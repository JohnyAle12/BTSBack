<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\HistoryRequest;
use App\Models\HistoryWeather;

class HistoryService 
{
    public function createHistory(HistoryRequest $request): HistoryWeather
    {
        return HistoryWeather::create([
            'user_id' => $request->user()->id,
            'city' => $request->city,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'humidity' => $request->humidity
        ]);
    }
}