<?php

namespace App\Services\PokeApi;

use App\Exceptions\ApiRequestNotFoundException;
use App\Models\DamageClass;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PokeApiDamageClassTypeService
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
        $damageClassesType = [];
        $allDamageClassesResponse = $this->client->request('GET','/api/v2/move-damage-class/');

        if ($allDamageClassesResponse->getStatusCode() == 404) throw new ApiRequestNotFoundException();

        $allDamageRelationTypes = json_decode($allDamageClassesResponse->getBody()->getContents(), true);
        foreach ($allDamageRelationTypes['results'] as $damageClassesListData) {
            $damageClassResponse = $this->client->request('GET', $damageClassesListData['url']);

            $damageClassData = json_decode($damageClassResponse->getBody()->getContents(), true);
            $damageClassesType[] = $this->parsePokeApiDamageClassesToDamageClassModel($damageClassData);
        }

        return $damageClassesType;
    }

    private function parsePokeApiDamageClassesToDamageClassModel($data): DamageClass
    {
        $damageClass = new DamageClass();

        $damageClass->name = $data['name'];

        foreach($data['descriptions'] as $description) {
            if ($description['language']['name'] != 'en') continue;
            $damageClass->description = $description['description'];
        }

        return $damageClass;
    }
}
