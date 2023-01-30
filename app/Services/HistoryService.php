<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\HistoryRequest;
use App\Models\HistoryWeather;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HistoryService 
{
    public function createHistory(HistoryRequest $request): JsonResponse
    {
        try {
            $history = HistoryWeather::create([
                'user_id' => $request->user()->id,
                'city' => $request->city,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'humidity' => $request->humidity
            ]);

            return response()->json([
                'message' => 'History was created successfuly',
                'history' => $history
            ], 201);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage(),
                'trace' => $ex->getTrace()
            ]);
        }
    }

    public function getHistory(Request $request): JsonResponse
    {   
        $history = HistoryWeather::where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json([
            'data' => $history
        ]);
    }
}