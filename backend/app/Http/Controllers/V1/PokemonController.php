<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Pokemon\Pokemon;
use App\Models\Pokemon\PokemonStat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PokemonController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $query = Pokemon::query();

        $query = Pokemon::with(['stats.stat', 'abilities.ability', 'moves.move.type', 'types.type']);

        // Filters

        $sortableFields = ['name', 'game_id', 'weight', 'height', 'base_experience'];
        $validStatNames = ['hp', 'attack', 'defense', 'special-attack', 'special-defense', 'speed'];


        Log::info($request->getQueryString());

        // Order by Pokemon fields

        foreach ($sortableFields as $field) {
            if ($request->has('sortBy' . ucfirst($field)) && in_array($request->input('sortBy' . ucfirst($field)), ['asc', 'desc'])) {
                $sortBy = $request->input('sortBy' . ucfirst($field));
                $query->orderBy($field, $sortBy);
            }
        }

        //Order by Name like

        if ($request->has('nameLike')) {
            $query->where('name', 'like', '%' . $request->input('nameLike') . '%');
        }


        // Order by Types

        if ($request->has('type')) {
            $types = $request->input('type');

            if (is_string($types)) {
                $types = explode(',', $types);
            }
            $query->whereHas('types.type', function ($q) use ($types) {
                $q->whereIn('name', $types);
            });
        }


        // Order by stats

        if ($request->has('stats')) {
            $stats = $request->input('stats');
            $statsArray = explode(',', $stats);

            foreach ($statsArray as $statOrder) {
                list($statName, $order) = explode(':', $statOrder);
                if (!in_array($statName, $validStatNames)) {
                    return response()->json(['error' => 'Invalid stat name provided. Valid values are: ' . implode(', ', $validStatNames)], 400);
                }

                if (in_array(strtolower($order), ['asc', 'desc'])) {
                    $query->whereHas('stats.stat', function ($q) use ($statName) {
                        $q->where('name', $statName);
                    })->orderBy(
                        PokemonStat::select('base')
                            ->whereColumn('pokemon_id', 'pokemon.game_id')
                            ->join('stats', 'stats.id', '=', 'pokemon_stats.stat_id')
                            ->where('stats.name', $statName),
                        $order
                    );
                }
            }
        }

        $paginationLimit = $request->input('limit', 10);

        // End Filters

        $pokemons = $query->paginate($paginationLimit);

        return response()->json($pokemons, 200);
    }


    public function getPokemonByIdentifier(Request $request, $identifier): JsonResponse
    {
        $query = Pokemon::with(['stats.stat', 'abilities.ability', 'moves.move.type', 'types.type']);

        if (is_numeric($identifier)) {
            $pokemon = $query->find($identifier);
        } else {
            $pokemon = $query->where('name', $identifier)->first();
        }

        if (!$pokemon) return response()->json(['error' => 'pokémon not found'], 404);

        return response()->json($pokemon);
    }
}
