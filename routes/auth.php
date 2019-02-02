<?php

Route::group([
    'prefix'    => 'home',
    'as'        => 'home.'
], function () {
    RouteMapperByArray(['stared', 'send', 'deleted', 'posted'], 'MessageHomeController', ['label']);
//    Route::get('/label/{label}', ['as' => 'label', 'uses' => 'MessageHomeController@label']);
});

Route::post('/createUsers', ['as' =>'createUsers', 'uses' => 'MessageHomeController@createUsers']);

Route::group([
    'prefix'    => 'autocomplete',
    'as'        => 'autocomplete.'
], function () {
    Route::get("/", 'AjaxAutocompleteController@index')->name('index');
    Route::post('/fetch', 'AjaxAutocompleteController@fetch')->name('fetch');
});

RouteMapperByArray(['star', 'stared', 'ajax'], 'AjaxAutocompleteController', [], 'post');


Route::resource('/home', 'MessageHomeController', ['except' => ['edit', 'update', 'destroy']]);
Route::post('/home/getUsers', 'MessageHomeController@getUsers')->name('home.getUsers');

Route::resource('/user', 'UserController', ['except' => ['index', 'create', 'store', 'show']]);

Route::group(['middleware' => 'fileAccessMiddleware'], function () {
    Route::any('files/{user}/{file}', 'FileController@getFile')->where('filename', '^[^/]+$');
    Route::any('photos/{user}/{file}', 'FileController@getFile')->where('filename', '^[^/]+$');
});