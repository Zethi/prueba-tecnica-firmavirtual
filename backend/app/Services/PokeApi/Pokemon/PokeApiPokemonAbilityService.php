<?php

namespace App\Services\PokeApi\Pokemon;

use App\Exceptions\ApiRequestNotFoundException;
use App\Models\Ability;
use App\Models\Pokemon\PokemonAbility;
use GuzzleHttp\Exception\GuzzleException;

class PokeApiPokemonAbilityService
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
        $pokemonsAbilities = [];
        $allPokemonListRawData = $this->pokeApiDataService->getAllPokemonData();

        foreach ($allPokemonListRawData as $pokemonRawData) {
            $pokemonData = $this->pokeApiDataService->getPokemonDataByUrl($pokemonRawData['url']);
            $pokemonAbilitiesModelArray = $this->parsePokeApiAbilitiesToAbilityModelArray($pokemonData);

            foreach ($pokemonAbilitiesModelArray as $pokemonAbilityModel) {
                $pokemonsAbilities[] = $pokemonAbilityModel;
            }
        }

        return $pokemonsAbilities;
    }

    private function parsePokeApiAbilitiesToAbilityModelArray($data): array
    {
        $pokemonAbilities = [];

        foreach ($data['abilities'] as $ability) {
            $abilityName = $ability['ability']['name'];

            $pokemonAbility = new PokemonAbility();
            $pokemonAbility->pokemon_id = $data['id'];
            $pokemonAbility->ability_id = Ability::all()->where('name', '==', $abilityName)->pluck('id')->first();
            $pokemonAbility->slot = $ability['slot'];
            $pokemonAbilities[] = $pokemonAbility;
        }

        return $pokemonAbilities;
    }
}
