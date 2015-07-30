<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('frontpage');
});

Route::post('hakutulokset', function(){
    return sprintf('Hakutulokset termille "%s"', Request::input('search'));
});
/*
Route::get('lahteet', function(){
    return view('springs.index')->with('springs', App\Spring::all());
});*/

Route::get('lahteet', 'SpringController@index');