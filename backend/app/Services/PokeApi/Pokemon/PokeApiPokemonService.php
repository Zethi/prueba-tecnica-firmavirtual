<?php

namespace App\Services\PokeApi\Pokemon;

use App\Exceptions\ApiRequestNotFoundException;
use App\Models\Pokemon\Pokemon;
use GuzzleHttp\Exception\GuzzleException;

class PokeApiPokemonService
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
        $pokemons = [];
        $allPokemonListRawData = $this->pokeApiDataService->getAllPokemonData();

        foreach ($allPokemonListRawData as $pokemonRawData) {
            $pokemonData = $this->pokeApiDataService->getPokemonDataByUrl($pokemonRawData['url']);
            $pokemonModel = $this->parsePokeApiPokemonToPokemonModel($pokemonData);

            $pokemons[] = $pokemonModel;
        }

        return $pokemons;
    }

    private function parsePokeApiPokemonToPokemonModel($data): Pokemon
    {
        $pokemon = new Pokemon();

        $pokemon->name = $data['name'];
        $pokemon->game_id = $data['id'];
        $pokemon->order = $data['order'];
        $pokemon->base_experience = $data['base_experience'];
        $pokemon->height = $data['height'];
        $pokemon->weight = $data['weight'];

        return $pokemon;
    }
}
