<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Organizer\OrganizerCompetitionController;
use App\Http\Controllers\Organizer\OrganizerCategoryController;
use App\Http\Controllers\Organizer\OrganizerGameController;
use App\Http\Controllers\Organizer\OrganizerPlayerController;
use App\Http\Controllers\Organizer\OrganizerScoresheetController;
use App\Http\Controllers\Organizer\OrganizerController;
use App\Http\Controllers\User\CompetitionController;
use App\Http\Controllers\User\GameController;




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
Route::get('organizer/competitions/index', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@index')->name('organizer.competitions.index');
Route::get('competitions/{id}/mats', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@showMats')->name('competitions.mats');
//【管理画面】大会
Route::get('organizer/competitions/create', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@create')->name('organizer.competitions.create');
Route::post('organizer/competitions/store', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@store')->name('organizer.competitions.store');
Route::get('organizer/competitions/{id}/show', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@show')->name('organizer.competitions.show');
//【管理画面】大会の選手登録画面
Route::get('organizer/competitions/{competition_id}/players/index', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@indexPlayer')->name('organizer.competitions.index-players');
Route::get('organizer/competitions/{competition_id}/players/create', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@createPlayer')->name('organizer.competitions.create-player');
Route::post('organizer/competitions/{competition_id}/players', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@storePlayer')->name('organizer.competitions.players.store');

//【管理画面】試合
Route::get('organizer/competitions/{competition_id}/games/index', 'App\Http\Controllers\Organizer\OrganizerGameController@index')->name('organizer.games.index');
Route::get('organizer/competitions/{competition_id}/games/create', 'App\Http\Controllers\Organizer\OrganizerGameController@create')->name('organizer.games.create');
Route::post('organizer/competitions/{competition_id}/games/store', 'App\Http\Controllers\Organizer\OrganizerGameController@store')->name('organizer.games.store');
Route::get('organizer/competitions/{competition_id}/games/create_final', 'App\Http\Controllers\Organizer\OrganizerGameController@createFinal')->name('organizer.games.create-final');
Route::post('organizer/competitions/{competition_id}/games/store_final', 'App\Http\Controllers\Organizer\OrganizerGameController@storeFinal')->name('organizer.games.store-final');
Route::get('organizer/competitions/{competition_id}/games/{game_id}/edit', 'App\Http\Controllers\Organizer\OrganizerGameController@edit')->name('organizer.games.edit');
Route::put('organizer/competitions/{competition_id}/games/{game_id}/update', 'App\Http\Controllers\Organizer\OrganizerGameController@update')->name('organizer.games.update');
Route::delete('organizer/competitions/{competition_id}/games/{game_id}/destroy', 'App\Http\Controllers\Organizer\OrganizerGameController@destroy')->name('organizer.games.destroy');
//【管理画面】スコアシート
Route::get('organizer/competitions/{competition_id}/games/{game_id}/scoresheets/create', 'App\Http\Controllers\Organizer\OrganizerScoresheetController@create')->name('organizer.scoresheets.create');
Route::post('organizer/competitions/{competition_id}/games/{game_id}/scoresheets/store', 'App\Http\Controllers\Organizer\OrganizerScoresheetController@store')->name('organizer.scoresheets.store');
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
//【ユーザー】大会一覧ページ
Route::get('competitions/index', 'App\Http\Controllers\User\CompetitionController@index')->name('users.competitions.index');
//【ユーザー】マット別試合順ページ
Route::get('competitions/{competition_id}/games', 'App\Http\Controllers\User\GameController@index')->name('users.games.index');
