<?php

namespace App\Services\PokeApi\Pokemon;

use App\Exceptions\ApiRequestNotFoundException;
use App\Models\Pokemon\PokemonStat;
use App\Models\Stat;
use GuzzleHttp\Exception\GuzzleException;

class PokeApiPokemonStatService
{
    protected $pokeApiDataService;

    public function __construct(PokeApiDataService $pokeApiDataService)
    {
        $this->pokeApiDataService = $pokeApiDataService;
    }

    /**
     * @throws GuzzleException
     * @throws ApiRequestNotFoundException
     */
    public function getAll(): array
    {
        $pokemonStats = [];
        $allPokemonListRawData = $this->pokeApiDataService->getAllPokemonData();

        foreach ($allPokemonListRawData as $pokemonRawData) {
            $pokemonData = $this->pokeApiDataService->getPokemonDataByUrl($pokemonRawData['url']);
            $pokemonStatModelArray = $this->parsePokeApiStatsToStatModelArray($pokemonData);

            foreach ($pokemonStatModelArray as $pokemonStatModel) {
                $pokemonStats[] = $pokemonStatModel;
            }
        }

        return $pokemonStats;
    }

    private function parsePokeApiStatsToStatModelArray($data): array
    {
        $pokemonStats = [];

        foreach ($data['stats'] as $stat) {
            $statName = $stat['stat']['name'];

            $pokemonStat = new PokemonStat();
            $pokemonStat->pokemon_id = $data['id'];
            $pokemonStat->stat_id = Stat::all()->where('name', '==', $statName)->pluck('id')->first();
            $pokemonStat->base = $stat['base_stat'];
            $pokemonStat->effort = $stat['effort'];
            $pokemonStats[] = $pokemonStat;
        }

        return $pokemonStats;
    }
}
