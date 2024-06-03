<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Move;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MoveController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $paginationLimit = $request->get('limit', 10);
        $moves = Move::query()->paginate($paginationLimit);

        return response()->json($moves, 200);
    }

    public function getMoveByIdentifier(Request $request, $identifier): JsonResponse
    {
        $query = Move::query();

        if (is_numeric($identifier)) {
            $move = $query->find($identifier);
        } else {
            $move = $query->where('name', $identifier)->first();
        }

        if (!$move) return response()->json(['error' => 'ability not found'], 404);

        return response()->json($move);
    }
}
