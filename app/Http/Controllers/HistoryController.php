<?php

namespace App\Http\Controllers;

use App\Http\Requests\HistoryRequest;
use App\Services\HistoryService;

class HistoryController extends Controller
{
    public function __construct(
        private HistoryService $historyService
    ) {
    }

    public function store(HistoryRequest $request)
    {
        try {
            $history = $this->historyService->createHistory($request);

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

}
