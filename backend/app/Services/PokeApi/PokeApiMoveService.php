<?php

namespace App\Services\PokeApi;

use App\Exceptions\ApiRequestNotFoundException;
use App\Models\DamageClass;
use App\Models\Move;
use App\Models\Type\Type;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PokeApiMoveService
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
        $moves = [];
        $allMovesResponse = $this->client->request('GET','/api/v2/move?limit=937');

        if ($allMovesResponse->getStatusCode() == 404) throw new ApiRequestNotFoundException();

        $allMovesRawListData = json_decode($allMovesResponse->getBody()->getContents(), true);
        foreach ($allMovesRawListData['results'] as $moveRawData) {
            try {
                $moveResponse = $this->client->request('GET', $moveRawData['url']);

                if ($moveResponse->getStatusCode() == 404) continue;

                $moveData = json_decode($moveResponse->getBody()->getContents(), true);
                $moveModel = $this->parsePokeApiMoveToMoveModel($moveData);
                $moves[] = $moveModel;
            } catch (GuzzleException $exc) {
                continue;
            }
        }

        return $moves;
    }


    private function parsePokeApiMoveToMoveModel($data): Move
    {
        $move = new Move();

        $moveTypeName = $data['type']['name'];
        $moveDamageClassName = $data['damage_class']['name'];

        $move->name = $data['name'];
        $move->pp = $data['pp'];
        $move->power = $data['power'];
        $move->priority = $data['priority'];
        $move->accuracy = $data['accuracy'];
        $move->damage_class_id = DamageClass::all()->where('name', '==', $moveDamageClassName)->pluck('id')->first();
        $move->type_id = Type::all()->where('name', '==', $moveTypeName)->pluck('id')->first();

        return $move;
    }
}
