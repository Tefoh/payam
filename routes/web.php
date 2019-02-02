<?php

Route::get('/', ['as'=>'home', 'uses'=>'Auth\LoginController@ShowLoginForm']);

Auth::routes();
Route::get('manage/login', 'Manage\ManageController@showLoginForm')->name('manage.login');
Route::post('manage/login', 'Manage\ManageController@login')->name('manage.login');

