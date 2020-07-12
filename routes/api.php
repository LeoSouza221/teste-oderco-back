<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('imposto', 'Api\ImpostoProdutoController@create');
Route::get('imposto', 'Api\ImpostoProdutoController@show');
Route::put('imposto', 'Api\ImpostoProdutoController@update');

Route::get('produto', 'Api\ProdutoController@show');
