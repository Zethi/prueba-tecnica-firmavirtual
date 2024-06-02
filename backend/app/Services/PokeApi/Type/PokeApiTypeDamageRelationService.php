<?php

namespace App\Services\PokeApi\Type;

use App\Exceptions\ApiRequestNotFoundException;
use App\Models\Type\DamageRelationType;
use App\Models\Type\Type;
use App\Models\Type\TypeDamageRelations;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PokeApiTypeDamageRelationService
{

    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => config('externalApi.pokeApi_base_url'), 'verify' => false]);
    }


    /**
     * @throws GuzzleException
     * @throws ApiRequestNotFoundException
     */
    public function getAll(): array
    {
        $damageRelations = [];
        $allTypesResponse = $this->client->request('GET', '/api/v2/type?limit=21');

        if ($allTypesResponse->getStatusCode() == 404) throw new ApiRequestNotFoundException();

        $allTypesListRawData = json_decode($allTypesResponse->getBody()->getContents(), true);
        foreach ($allTypesListRawData['results'] as $typeRawData) {
            $typeResponse = $this->client->request('GET', $typeRawData['url']);

            if ($typeResponse->getStatusCode() == 404) continue;

            $typeData = json_decode($typeResponse->getBody()->getContents(), true);
            $damageRelationsList = $this->parsePokeApiDamageRelationToDamageRelationModelArray($typeData);

            foreach ($damageRelationsList as $damageRelation) {
                $damageRelations[] = $damageRelation;
            }
        }

        return $damageRelations;
    }


    private function parsePokeApiDamageRelationToDamageRelationModelArray($data): array
    {
        $damageRelations = [];

        $keys = array_keys($data['damage_relations']);

        foreach ($keys as $key) {
            $damageRelation = new TypeDamageRelations();
            $keyRelations = $data['damage_relations'][$key];
            foreach ($keyRelations as $keyRelation) {
                $damageRelation->from_type_id = $data['id'];
                $damageRelation->damage_relation_type_id = DamageRelationType::all()->where('name', '==', $key)->pluck('id')->first();
                $damageRelation->to_type_id = Type::all()->where('name', $keyRelation['name'])->pluck('id')->first();
                $damageRelations[] = $damageRelation;
            }
        }

        return $damageRelations;
    }
}
