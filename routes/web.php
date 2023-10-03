<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GameController;


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
Route::get('organizer/competitions/{id}/players/create', 'App\Http\Controllers\CompetitionController@playersCreate')->name('organizer.competitions.players.create');
Route::post('organizer/competitions/{id}/players/store', 'App\Http\Controllers\CompetitionController@playersStore')->name('organizer.competitions.players.store');
Route::get('competition/{id}/players', 'App\Http\Controllers\CompetitionController@playersStore')->name('competitions.players');
