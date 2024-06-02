<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\DamageClass;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DamageClassController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $moves = DamageClass::query()->get();

        return response()->json($moves, 200);
    }

    public function getDamageClassByIdentifier(Request $request, $identifier): JsonResponse
    {
        $query = DamageClass::query();

        if (is_numeric($identifier)) {
            $stat = $query->find($identifier);
        } else {
            $stat = $query->where('name', $identifier)->first();
        }

        if (!$stat) return response()->json(['error' => 'damage_class not found'], 404);

        return response()->json($stat);
    }
}
