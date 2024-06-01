<?php

namespace App\Services\PokeApi\Pokemon;

use App\Exceptions\ApiRequestNotFoundException;
use App\Models\Pokemon\PokemonType;
use App\Models\Type\Type;
use GuzzleHttp\Exception\GuzzleException;

class PokeApiPokemonTypeService
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
        $pokemonTypes = [];
        $allPokemonListRawData = $this->pokeApiDataService->getAllPokemonData();

        foreach ($allPokemonListRawData as $pokemonRawData) {
            $pokemonData = $this->pokeApiDataService->getPokemonDataByUrl($pokemonRawData['url']);
            $pokemonTypesModelArray = $this->parsePokeApiTypeToTypeModel($pokemonData);

            foreach ($pokemonTypesModelArray as $pokemonTypeModel) {
                $pokemonTypes[] = $pokemonTypeModel;
            }
        }

        return $pokemonTypes;
    }

    private function parsePokeApiTypeToTypeModel($data): array
    {
        $pokemonTypes = [];

        foreach ($data['types'] as $type) {
            $pokemonType = new PokemonType();
            $pokemonType->pokemon_id = $data['id'];
            $pokemonType->type_id = Type::all()->where('name', $type['type']['name'])->pluck('id')->first();
            $pokemonType->slot = $type['slot'];
            $pokemonTypes[] = $pokemonType;
        }

        return $pokemonTypes;
    }
}
