<?php

namespace App\Http\Controllers;

use App\Http\Requests\HistoryRequest;
use App\Services\HistoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function __construct(
        private HistoryService $historyService
    ) {
    }

    public function index(Request $request): JsonResponse
    {
        return $this->historyService->getHistory($request);
    }

    public function store(HistoryRequest $request): JsonResponse
    {
        return $this->historyService->createHistory($request);
    }
}

