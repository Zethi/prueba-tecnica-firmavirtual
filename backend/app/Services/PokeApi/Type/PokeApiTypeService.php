<?php

namespace App\Services\PokeApi\Type;

use App\Exceptions\ApiRequestNotFoundException;
use App\Models\Type\Type;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PokeApiTypeService
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
        $types = [];
        $allTypesResponse = $this->client->request('GET', '/api/v2/type?limit=21');

        if ($allTypesResponse->getStatusCode() == 404) throw new ApiRequestNotFoundException();

        $allTypeListRawData = json_decode($allTypesResponse->getBody()->getContents(), true);
        foreach ($allTypeListRawData['results'] as $typeRawData) {
            $moveResponse = $this->client->request('GET', $typeRawData['url']);

            if ($moveResponse->getStatusCode() == 404) continue;

            $typeData = json_decode($moveResponse->getBody()->getContents(), true);
            $typeModel = $this->parsePokeApiTypeToTypeModel($typeData);
            $types[] = $typeModel;
        }

        return $types;
    }


    private function parsePokeApiTypeToTypeModel($data): Type
    {
        $type = new Type();

        $type->name = $data['name'];

        return $type;
    }
}
