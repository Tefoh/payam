<?php


Route::get('/', ['as'=>'home', 'uses'=>'Auth\LoginController@ShowLoginForm']);

Auth::routes();

