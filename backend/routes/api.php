<?php

use App\Http\Controllers\HealthCheckController;
use App\Http\Controllers\V1\AbilityController;
use App\Http\Controllers\V1\DamageClassController;
use App\Http\Controllers\V1\MoveController;
use App\Http\Controllers\V1\PokemonController;
use App\Http\Controllers\V1\StatsController;
use App\Http\Controllers\V1\TypesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/healthcheck', [HealthCheckController::class, 'check']);

Route::prefix('v1')->group(function () {
    Route::prefix('pokemon')->group(function () {
        Route::get('/', [PokemonController::class, 'index']);
        Route::get('/{identifier}', [PokemonController::class, 'getPokemonByIdentifier']);
    });

    Route::prefix('ability')->group(function () {
        Route::get('/', [AbilityController::class, 'index']);
        Route::get('/{identifier}', [AbilityController::class, 'getAbilityByIdentifier']);
    });

    Route::prefix('move')->group(function () {
        Route::get('/', [MoveController::class, 'index']);
        Route::get('/{identifier}', [MoveController::class, 'getMoveByIdentifier']);
    });

    Route::prefix('stat')->group(function () {
        Route::get('/', [StatsController::class, 'index']);
        Route::get('/{identifier}', [StatsController::class, 'getStatByIdentifier']);
    });

    Route::prefix('type')->group(function () {
        Route::get('/', [TypesController::class, 'index']);
        Route::get('/{identifier}', [TypesController::class, 'getTypeByIdentifier']);
    });

    Route::prefix('damage-class')->group(function () {
        Route::get('/', [DamageClassController::class, 'index']);
        Route::get('/{identifier}', [DamageClassController::class, 'getDamageClassByIdentifier']);
    });
});

