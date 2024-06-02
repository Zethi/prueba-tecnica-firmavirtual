<?php

namespace App\Services\PokeApi;

use App\Exceptions\ApiRequestNotFoundException;
use App\Models\Stat;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PokeApiStatService
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
    public function getAll(): array
    {
        $statTypes = [];
        $allStatTypesResponse = $this->client->request('GET','/api/v2/stat/');

        if ($allStatTypesResponse->getStatusCode() == 404) throw new ApiRequestNotFoundException();

        $allStatTypes = json_decode($allStatTypesResponse->getBody()->getContents(), true);
        foreach ($allStatTypes['results'] as $key => $ability) {
            $statTypeResponse = $this->client->request('GET', $ability['url']);

            if ($statTypeResponse->getStatusCode() == 404) throw new ApiRequestNotFoundException();
            $statTypeData = json_decode($statTypeResponse->getBody()->getContents(), true);
            $statTypeModel = $this->parsePokeApiStatTypeToStatModel($statTypeData);
            $statTypes[] = $statTypeModel;
        }

        return $statTypes;
    }


    private function parsePokeApiStatTypeToStatModel($data): Stat
    {
        $stat = new Stat();

        $stat->name = $data['name'];
        $stat->game_index = $data['game_index'];
        $stat->is_battle_only = $data['is_battle_only'];

        return $stat;
    }
}
