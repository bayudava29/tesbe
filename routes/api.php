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

Route::prefix('article')->group(function($router){
    $router->post('/', 'PostController@storeArticle');
    $router->get('/', 'PostController@getAllArticle');
    $router->get('{id}', 'PostController@findArticle');
    $router->post('{id}', 'PostController@updateArticle');
    $router->post('delete/{id}', 'PostController@deleteArticle');
});
