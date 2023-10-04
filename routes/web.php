<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PlayerController;


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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::resource('/competitions', CompetitionController::class)->names('competitions');
Route::get('competitions/{id}/mats', 'App\Http\Controllers\CompetitionController@showMats')->name('competitions.mats');
Route::get('organizer/competitions/create', 'App\Http\Controllers\CompetitionController@create')->name('organizer.competitions.create');
Route::post('organizer/competitions/store', 'App\Http\Controllers\CompetitionController@store')->name('organizer.competitions.store');
Route::get('organizer/competitions/{id}/games/create', 'App\Http\Controllers\CompetitionController@gameCreate')->name('organizer.competitions.games.create');
Route::post('organizer/competitions/{id}/games/store', 'App\Http\Controllers\CompetitionController@gameStore')->name('organizer.competitions.games.store');
// Route::get('organizer/competitions/{id}/players/create', 'App\Http\Controllers\CompetitionController@playersCreate')->name('organizer.competitions.players.create');
// Route::post('organizer/competitions/{id}/players/store', 'App\Http\Controllers\CompetitionController@playersStore')->name('organizer.competitions.players.store');
// Route::get('organizer/competitions/{id}/players', 'App\Http\Controllers\CompetitionController@players')->name('organizer.competitions.players.index');
//Route::get('competition/{id}/players', 'App\Http\Controllers\CompetitionController@playersStore')->name('competitions.players');
//Route::resource('organizer/players/index', PlayerController::class)->names('organizer.players.index');
Route::get('organizer/players/index', 'App\Http\Controllers\PlayerController@index')->name('organizer.players.index');
Route::get('organizer/players/create', 'App\Http\Controllers\PlayerController@create')->name('organizer.players.create');
Route::post('organizer/players/store', 'App\Http\Controllers\PlayerController@store')->name('organizer.players.store');
Route::get('organizer/player/{id}/show', 'App\Http\Controllers\PlayerController@show')->name('organizer.players.show');
Route::get('organizer/player/{id}/edit', 'App\Http\Controllers\PlayerController@edit')->name('organizer.players.edit');
Route::put('organizer/player/{id}/update', 'App\Http\Controllers\PlayerController@update')->name('organizer.players.update');
Route::delete('organizer/player/{id}/destroy', 'App\Http\Controllers\PlayerController@destroy')->name('organizer.players.destroy');
Route::get('organizer/teams/index', 'App\Http\Controllers\TeamController@index')->name('organizer.teams.index');
Route::get('organizer/teams/create', 'App\Http\Controllers\TeamController@create')->name('organizer.teams.create');
Route::post('organizer/teams/store', 'App\Http\Controllers\TeamController@store')->name('organizer.teams.store');
Route::delete('organizer/teams/{id}/destroy', 'App\Http\Controllers\TeamController@destroy')->name('organizer.teams.destroy');
