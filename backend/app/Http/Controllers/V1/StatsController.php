<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Stat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $moves = Stat::query()->get();

        return response()->json($moves, 200);
    }

    public function getStatByIdentifier(Request $request, $identifier): JsonResponse
    {
        $query = Stat::query();

        if (is_numeric($identifier)) {
            $stat = $query->find($identifier);
        } else {
            $stat = $query->where('name', $identifier)->first();
        }

        if (!$stat) return response()->json(['error' => 'stat not found'], 404);

        return response()->json($stat);
    }
}
