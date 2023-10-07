<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Organizer\OrganizerCompetitionController;
use App\Http\Controllers\Organizer\OrganizerCategoryController;
use App\Http\Controllers\Organizer\OrganizerGameController;
use App\Http\Controllers\Organizer\OrganizerPlayerController;
use App\Http\Controllers\Organizer\OrganizerController;


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
//【管理画面】大会一覧
Route::resource('organizer/competitions/index', OrganizerCompetitionController::class)->names('organizer.competitions');
Route::get('competitions/{id}/mats', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@showMats')->name('competitions.mats');
//【管理画面】大会
Route::get('organizer/competitions/create', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@create')->name('organizer.competitions.create');
Route::post('organizer/competitions/store', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@store')->name('organizer.competitions.store');
//【管理画面】試合
Route::get('organizer/competitions/{id}/games/create', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@gameCreate')->name('organizer.games.create');
Route::post('organizer/competitions/{id}/games/store', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@gameStore')->name('organizer.games.store');
//【管理画面】選手
Route::get('organizer/players/index', 'App\Http\Controllers\Organizer\OrganizerPlayerController@index')->name('organizer.players.index');
Route::get('organizer/players/create', 'App\Http\Controllers\Organizer\OrganizerPlayerController@create')->name('organizer.players.create');
Route::post('organizer/players/store', 'App\Http\Controllers\Organizer\OrganizerPlayerController@store')->name('organizer.players.store');
Route::get('organizer/player/{id}/show', 'App\Http\Controllers\Organizer\OrganizerPlayerController@show')->name('organizer.players.show');
Route::get('organizer/player/{id}/edit', 'App\Http\Controllers\Organizer\OrganizerPlayerController@edit')->name('organizer.players.edit');
Route::put('organizer/player/{id}/update', 'App\Http\Controllers\Organizer\OrganizerPlayerController@update')->name('organizer.players.update');
Route::delete('organizer/player/{id}/destroy', 'App\Http\Controllers\Organizer\OrganizerPlayerController@destroy')->name('organizer.players.destroy');
//【管理画面】チーム
Route::get('organizer/teams/index', 'App\Http\Controllers\Organizer\OrganizerTeamController@index')->name('organizer.teams.index');
Route::get('organizer/teams/create', 'App\Http\Controllers\Organizer\OrganizerTeamController@create')->name('organizer.teams.create');
Route::post('organizer/teams/store', 'App\Http\Controllers\Organizer\OrganizerTeamController@store')->name('organizer.teams.store');
Route::delete('organizer/teams/{id}/destroy', 'App\Http\Controllers\Organizer\OrganizerTeamController@destroy')->name('organizer.teams.destroy');
//【管理画面】マット
Route::get('organizer/competitions/{id}/mats/create', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@matsCreate')->name('organizer.mats.create');
Route::post('organizer/competitions/{id}/mats/store', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@matsStore')->name('organizer.mats.store');
//【管理画面】トップページ
Route::get('organizer/index', 'App\Http\Controllers\Organizer\OrganizerController@index')->name('organizer.index');
