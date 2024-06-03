<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Type\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TypesController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $type = Type::query()->with(['damageRelations.damageRelationType', 'damageRelations.toType'])->get();

        return response()->json($type, 200);
    }

    public function getTypeByIdentifier(Request $request, $identifier): JsonResponse
    {
        $query = Type::query()->with(['damageRelations.damageRelationType', 'damageRelations.toType']);

        if (is_numeric($identifier)) {
            $type = $query->find($identifier);
        } else {
            $type = $query->where('name', $identifier)->first();
        }

        if (!$type) return response()->json(['error' => 'stat not found'], 404);

        return response()->json($type);
    }
}
