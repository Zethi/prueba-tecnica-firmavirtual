<?php

namespace App\Services\PokeApi\Pokemon;

use App\Exceptions\ApiRequestNotFoundException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PokeApiDataService
{
    protected $client;
    protected $allPokemonData;
    protected $pokemonDataCache = [];

    public function __construct()
    {
        $this->client = new Client(['base_uri' => config('externalApi.pokeApi_base_url'), 'verify' => false]);
    }

    /**
     * @throws GuzzleException
     * @throws ApiRequestNotFoundException
     */
    public function getAllPokemonData(): array
    {
        if ($this->allPokemonData === null) {
            $allPokemonResponse = $this->client->request('GET', '/api/v2/pokemon?limit=1302');

            if ($allPokemonResponse->getStatusCode() == 404) throw new ApiRequestNotFoundException();

            $this->allPokemonData = json_decode($allPokemonResponse->getBody()->getContents(), true)['results'];
        }

        return $this->allPokemonData;
    }

    /**
     * @throws GuzzleException
     * @throws ApiRequestNotFoundException
     */
    public function getPokemonDataByUrl($url): array
    {
        if (isset($this->pokemonDataCache[$url])) {
            return $this->pokemonDataCache[$url];
        }

        $pokemonResponse = $this->client->request('GET', $url);

        if ($pokemonResponse->getStatusCode() == 404) throw new ApiRequestNotFoundException();

        $pokemonData = json_decode($pokemonResponse->getBody()->getContents(), true);
        $this->pokemonDataCache[$url] = $pokemonData;

        return $pokemonData;
    }
}
