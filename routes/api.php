<?php

Route::group([

], function () {

    Route::post('login', 'ApiController@login');
    Route::post('logout', 'ApiController@logout');
    Route::post('refresh', 'ApiController@refresh');
    Route::post('me', 'ApiController@me');
    Route::get('messages', 'ApiController@messages');

});
