<?php

namespace App\Services\PokeApi;

use App\Exceptions\ApiRequestNotFoundException;
use App\Models\Ability;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PokeApiAbilityService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([ 'base_uri' => config('externalApi.pokeApi_base_url'), 'verify' => false ]);
    }

    /**
     * @throws GuzzleException
     * @throws ApiRequestNotFoundException
     */
    public function getAll(): array {
        $abilities = [];

        $allAbilitiesResponse = $this->client->request('GET','/api/v2/ability?limit=367');
        if ($allAbilitiesResponse->getStatusCode() == 404) throw new ApiRequestNotFoundException();

        $allAbilities = json_decode($allAbilitiesResponse->getBody()->getContents(), true);
        foreach ($allAbilities['results'] as $key => $ability) {
            $abilityDataResponse = $this->client->request('GET', $ability['url']);

            if ($abilityDataResponse->getStatusCode() == 404) throw new ApiRequestNotFoundException();
            $abilityData = json_decode($abilityDataResponse->getBody()->getContents(), true);

            $abilityModel = $this->parsePokeApiAbilityResponseToAbility($abilityData);
            $abilities[] = $abilityModel;
        }
        return $abilities;
    }

    /**
     * @throws GuzzleException
     * @throws ApiRequestNotFoundException
     */
    public function getById($id): Ability
    {
        $abilityResponse = $this->client->request('GET','/ability/' . $id);

        if ($abilityResponse->getStatusCode() == 404) throw new ApiRequestNotFoundException();

        return $this->parsePokeApiAbilityResponseToAbility(json_decode($abilityResponse->getBody()->getContents(), true));
    }

    private function parsePokeApiAbilityResponseToAbility($data): Ability
    {
        $ability = new Ability();
        $ability->name = $data['name'];
        $ability->game_order = $data['id'];

        $effects = $data["effect_entries"];

        foreach($effects as $effect) {
            if ($effect['language']['name'] != 'en') continue;
            $ability->effect = $effect['effect'];
            $ability->short_effect = $effect['short_effect'];
        }

        return $ability;
    }
}
