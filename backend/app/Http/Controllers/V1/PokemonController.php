<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Pokemon\Pokemon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PokemonController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $query = Pokemon::query();

        $query->with(['stats.stat']);
        $query->with(['abilities.ability']);
        $query->with(['moves.move']);
        $query->with(['types.type']);

        // Filters

        $sortableFields = ['name', 'game_id', 'weight', 'height', 'base_experience'];
        $validStatNames = ['hp', 'attack', 'defense', 'special-attack', 'special-defense', 'speed'];


        if ($request->has('nameLike')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        foreach ($sortableFields as $field) {
            if ($request->has('sortBy' . ucfirst($field)) && in_array($request->input('sortBy' . ucfirst($field)), ['asc', 'desc'])) {
                $sortBy = $request->input('sortBy' . ucfirst($field));
                $query->orderBy($field, $sortBy);
            }
        }

        if ($request->has('statName') && $request->has('statValue')) {
            $statName = $request->input('statName');
            $statValue = $request->input('statValue');
            $query->whereHas('stats', function ($q) use ($statName, $statValue) {
                $q->whereHas('stat', function ($q) use ($statName) {
                    $q->where('name', $statName);
                })->where('base', '>=', $statValue);
            });
        }

        if ($request->has('type')) {
            $type = $request->input('type');
            $query->whereHas('types.type', function ($q) use ($type) {
                $q->where('name', $type);
            });
        }

        if ($request->has('sortStatName') && $request->has('sortStatOrder') && in_array($request->input('sortStatOrder'), ['asc', 'desc'])) {
            $sortStatName = $request->input('sortStatName');
            $sortStatOrder = $request->input('sortStatOrder');

            if (!in_array($sortStatName, $validStatNames)) {
                return response()->json(['error' => 'Invalid sortStatName provided. Valid values are: ' . implode(', ', $validStatNames)], 400);
            }

            $query->whereHas('stats.stat', function ($q) use ($sortStatName) {
                $q->where('name', $sortStatName);
            })->orderBy(function ($q) use ($sortStatName) {
                $q->select('base')
                    ->from('pokemon_stats')
                    ->join('stats', 'pokemon_stats.stat_id', '=', 'stats.id')
                    ->whereColumn('pokemon_stats.pokemon_id', 'pokemons.id')
                    ->where('stats.name', $sortStatName);
            }, $sortStatOrder);
        }

        // End Filters

        $paginationLimit = $request->input('limit', 10);
        $pokemons = $query->paginate($paginationLimit);

        return response()->json($pokemons, 200);
    }

    public function getPokemonByIdentifier(Request $request, $identifier): JsonResponse
    {
        $query = Pokemon::with(['stats.stat', 'abilities.ability', 'moves.move', 'types.type']);

        if (is_numeric($identifier)) {
            $pokemon = $query->find($identifier);
        } else {
            $pokemon = $query->where('name', $identifier)->first();
        }

        if (!$pokemon) return response()->json(['error' => 'pokémon not found'], 404);

        return response()->json($pokemon);
    }
}
