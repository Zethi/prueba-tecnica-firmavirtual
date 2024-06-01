<?php

namespace Database\Seeders;

use App\Exceptions\ApiRequestNotFoundException;
use App\Models\Ability;
use App\Models\Pokemon\PokemonMove;
use App\Models\Type\DamageRelationType;
use App\Services\PokeApi\PokeApiAbilityService;
use App\Services\PokeApi\PokeApiDamageClassTypeService;
use App\Services\PokeApi\PokeApiMoveService;
use App\Services\PokeApi\PokeApiStatService;
use App\Services\PokeApi\Pokemon\PokeApiDataService;
use App\Services\PokeApi\Pokemon\PokeApiPokemonAbilityService;
use App\Services\PokeApi\Pokemon\PokeApiPokemonMoveService;
use App\Services\PokeApi\Pokemon\PokeApiPokemonService;
use App\Services\PokeApi\Pokemon\PokeApiPokemonStatService;
use App\Services\PokeApi\Pokemon\PokeApiPokemonTypeService;
use App\Services\PokeApi\Type\PokeApiTypeDamageRelationService;
use App\Services\PokeApi\Type\PokeApiTypeService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $dataService = new PokeApiDataService();

        $this->seedPokemonMoves($dataService);
    }

    /**
     * @throws GuzzleException
     * @throws ApiRequestNotFoundException
     */
    private function seedAbilities(): void
    {
        $abilityService = new PokeApiAbilityService();

        $abilities = $abilityService->getAll();

        foreach ($abilities as $ability) {
            $ability->save();
        }
    }

    /**
     * @throws GuzzleException
     * @throws ApiRequestNotFoundException
     */
    private function seedStatTypes(): void
    {
        $statTypeService = new PokeApiStatService();

        $statTypes = $statTypeService->getAll();

        foreach ($statTypes as $statType) {
            $statType->save();
        }
    }

    /**
     * @throws GuzzleException
     * @throws ApiRequestNotFoundException
     */
    private function seedDamageClassTypes(): void
    {
        $damageClassTypeService = new PokeApiDamageClassTypeService();

        $damageClassTypes = $damageClassTypeService->getAll();

        foreach ($damageClassTypes as $damageRelationType) {
            $damageRelationType->save();
        }
    }

    /**
     * @throws GuzzleException
     * @throws ApiRequestNotFoundException
     */
    private function seedPokemons(PokeApiDataService $dataService): void
    {
        $pokemonService = new PokeApiPokemonService($dataService);

        $pokemons = $pokemonService->getAll();

        foreach ($pokemons as $pokemon) {
            $pokemon->save();
        }
    }

    /**
     * @throws GuzzleException
     * @throws ApiRequestNotFoundException
     */
    private function seedMoves(): void
    {
        $moveService = new PokeApiMoveService();

        $moveTypes = $moveService->getAll();

        foreach ($moveTypes as $moveType) {
            $moveType->save();
        }
    }

    /**
     * @throws GuzzleException
     * @throws ApiRequestNotFoundException
     */
    private function seedTypes(): void
    {
        $typeService = new PokeApiTypeService();

        $types = $typeService->getAll();

        foreach ($types as $type) {
            $type->save();
        }
    }

    private function seedDamageRelationTypes(): void
    {
        $doubleDamageFrom = new DamageRelationType();
        $doubleDamageFrom->name = 'double_damage_from';

        $doubleDamageTo = new DamageRelationType();
        $doubleDamageTo->name = 'double_damage_to';

        $halfDamageFrom = new DamageRelationType();
        $halfDamageFrom->name = 'half_damage_from';

        $halfDamageTo = new DamageRelationType();
        $halfDamageTo->name = 'half_damage_to';

        $noDamageFrom = new DamageRelationType();
        $noDamageFrom->name = 'no_damage_from';

        $noDamageTo = new DamageRelationType();
        $noDamageTo->name = 'no_damage_to';

        $doubleDamageFrom->save();
        $doubleDamageTo->save();
        $halfDamageFrom->save();
        $halfDamageTo->save();
        $noDamageFrom->save();
        $noDamageTo->save();
    }

    /**
     * @throws GuzzleException
     * @throws ApiRequestNotFoundException
     */
    private function seedDamageRelations(): void
    {
        $damageRelationsService = new PokeApiTypeDamageRelationService();

        $damageRelations = $damageRelationsService->getAll();

        foreach ($damageRelations as $damageRelation) {
            $damageRelation->save();
        }
    }

    /**
     * @throws GuzzleException
     * @throws ApiRequestNotFoundException
     */
    private function seedPokemonTypes(PokeApiDataService $dataService): void
    {
        $pokemonTypeService = new PokeApiPokemonTypeService($dataService);

        $allPokemonTypes = $pokemonTypeService->getAll();

        foreach ($allPokemonTypes as $pokemonType) {
            $pokemonType->save();
        }
    }

    /**
     * @throws GuzzleException
     * @throws ApiRequestNotFoundException
     */
    private function seedPokemonAbilities(PokeApiDataService $dataService): void
    {
        $pokemonAbilityService = new PokeApiPokemonAbilityService($dataService);

        $pokemonAbilities = $pokemonAbilityService->getAll();

        foreach ($pokemonAbilities as $pokemonAbility) {
            $pokemonAbility->save();
        }
    }

    /**
     * @throws GuzzleException
     * @throws ApiRequestNotFoundException
     */
    private function seedPokemonStats(PokeApiDataService $dataService): void
    {
        $pokemonStatService = new PokeApiPokemonStatService($dataService);

        $pokemonStats = $pokemonStatService->getAll();

        foreach ($pokemonStats as $pokemonStat) {
            $pokemonStat->save();
        }
    }

    /**
     * @throws GuzzleException
     * @throws ApiRequestNotFoundException
     */
    private function seedPokemonMoves(PokeApiDataService $dataService): void
    {
        $pokemonMoveService = new PokeApiPokemonMoveService($dataService);

        $pokemonMoves = $pokemonMoveService->getAll();

        foreach ($pokemonMoves as $pokemonMove) {
            $pokemonMove->save();
        }
    }
}
