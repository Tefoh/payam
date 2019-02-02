<?php

Route::get('/', 'ManageController@index')->name('index');


Route::get('permission', 'ManageController@index')->name('permission');
Route::get('role', 'ManageController@index')->name('role');

Route::group([
    'prefix' => 'user',
    'as'     => 'user.'
], function () {
    Route::get('{user}', 'ManageController@index')->name('show');
    Route::get('baned', 'ManageController@index')->name('baned');
    Route::post('ban', 'UserController@ban')->name('ban');
    Route::delete('destroy', 'UserController@destroy')->name('destroy');
});
