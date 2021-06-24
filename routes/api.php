<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'users'
], function ($router) {

    Route::post('add', 'UsersController@store');
});

Route::group([
    'prefix' => 'auth'
], function ($router) {

    Route::post('login', 'AuthController@login');
});

Route::group(
    [
        'prefix' => 'acampamento'
    ],
    function ($router) {
        Route::get('/', 'AcampamentosController@index');
        Route::get('/view/{id}', 'AcampamentosController@view');
        Route::post('add', 'AcampamentosController@store');
    }
);

Route::group(
    [
        'prefix' => 'enderecos',
    ],
    function ($router) {
        Route::get('/opcoesfilter', 'EnderecosController@enderecoFiltroEstado');
        Route::get('/opcoesfilterMunicipio/{estado}', 'EnderecosController@enderecoFiltroMunicipio');
    }
);
