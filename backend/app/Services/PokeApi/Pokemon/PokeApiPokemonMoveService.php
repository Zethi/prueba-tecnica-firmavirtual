<?php

namespace App\Services\PokeApi\Pokemon;

use App\Exceptions\ApiRequestNotFoundException;
use App\Models\Move;
use App\Models\Pokemon\PokemonMove;
use GuzzleHttp\Exception\GuzzleException;

class PokeApiPokemonMoveService
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
        $pokemonMoves = [];
        $allPokemonListRawData = $this->pokeApiDataService->getAllPokemonData();

        foreach ($allPokemonListRawData as $pokemonRawData) {
            $pokemonData = $this->pokeApiDataService->getPokemonDataByUrl($pokemonRawData['url']);
            $pokemonMoveModelArray = $this->parsePokeApiMovesToMoveModelArray($pokemonData);

            foreach ($pokemonMoveModelArray as $pokemonMoveModel) {
                $pokemonMoves[] = $pokemonMoveModel;
            }
        }

        return $pokemonMoves;
    }

    private function parsePokeApiMovesToMoveModelArray($data): array
    {
        $pokemonMoves = [];

        $allMoves = Move::all()->keyBy('name')->toArray();

        foreach ($data['moves'] as $move) {
            $moveName = $move['move']['name'];

            if (isset($allMoves[$moveName])) {
                $moveId = $allMoves[$moveName]['id'];

                $pokemonMove = new PokemonMove();
                $pokemonMove->pokemon_id = $data['id'];
                $pokemonMove->move_id = $moveId;
                $pokemonMoves[] = $pokemonMove;
            }
        }

        return $pokemonMoves;
    }
}
