<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Ability;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AbilityController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $paginationLimit = $request->get('limit', 10);
        $abilities = Ability::query()->paginate($paginationLimit);

        return response()->json($abilities, 200);
    }

    public function getAbilityByIdentifier(Request $request, $identifier): JsonResponse
    {
        $query = Ability::query();

        if (is_numeric($identifier)) {
            $ability = $query->find($identifier);
        } else {
            $ability = $query->where('name', $identifier)->first();
        }

        if (!$ability) return response()->json(['error' => 'Ability not found'], 404);

        return response()->json($ability);
    }
}
