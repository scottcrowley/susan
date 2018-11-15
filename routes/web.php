<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth',
    'namespace' => 'Admin'
], function () {
    Route::get('/', 'DashboardController@index')->name('admin.index');

    Route::get('/cards', 'CardsController@index')->name('admin.cards.index');
    Route::get('/cards/create', 'CardsController@create')->name('admin.cards.create');
    Route::post('/cards', 'CardsController@store')->name('admin.cards.store');
    Route::get('/cards/{card}', 'CardsController@show')->name('admin.cards.show');
    Route::post('/cards/{card}', 'CardsController@update')->name('admin.cards.update');

    Route::get('/powers', 'PowersController@index')->name('admin.powers.index');
    Route::get('/powers/create', 'PowersController@create')->name('admin.powers.create');
    Route::post('/powers', 'PowersController@store')->name('admin.powers.store');
    Route::get('/powers/{power}', 'PowersController@show')->name('admin.powers.show');
    Route::post('/powers/{power}', 'PowersController@update')->name('admin.powers.update');

    Route::get('/rarities', 'RaritiesController@index')->name('admin.rarities.index');
    Route::get('/rarities/create', 'RaritiesController@create')->name('admin.rarities.create');
    Route::post('/rarities', 'RaritiesController@store')->name('admin.rarities.store');
    Route::get('/rarities/{rarity}', 'RaritiesController@show')->name('admin.rarities.show');
    Route::post('/rarities/{rarity}', 'RaritiesController@update')->name('admin.rarities.update');
});
