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
use App\Http\Controllers\User\ClassfiedCompetitionPlayerController;
use App\Http\Controllers\User\UserFavoriteController;
use App\Models\ClassfiedCompetitionPlayer;
use App\Models\User;

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

Auth::routes(['verify' => true]);


//TODO ログイン後のリダイレクト先設定

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

// 管理者ページ
Route::group(['middleware' => ['auth', 'can:admin']], function () {

    //【管理画面】大会一覧
    Route::get('organizer/competitions/index', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@index')->name('organizer.competitions.index');
    Route::get('competitions/{id}/mats', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@showMats')->name('competitions.mats');
    //【管理画面】大会会場
    Route::get('organizer/places/index', 'App\Http\Controllers\Organizer\OrganizerPlaceController@index')->name('organizer.places.index');
    Route::get('organizer/place/create', 'App\Http\Controllers\Organizer\OrganizerPlaceController@create')->name('organizer.places.create');
    Route::post('organizer/place/store', 'App\Http\Controllers\Organizer\OrganizerPlaceController@store')->name('organizer.places.store');
    Route::delete('organizer/place/{id}/destroy', 'App\Http\Controllers\Organizer\OrganizerPlaceController@destroy')->name('organizer.places.destroy');
    //【管理画面】大会
    Route::get('organizer/competitions/create', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@create')->name('organizer.competitions.create');
    Route::post('organizer/competitions/store', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@store')->name('organizer.competitions.store');
    Route::get('organizer/competitions/{competition}/show', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@show')->name('organizer.competitions.show');
    //【管理画面】カテゴリ別大会
    Route::get('organizer/competitions/{competition}/categoriezed_competitions/create', 'App\Http\Controllers\Organizer\OrganizerCategoriezedCompetitionController@create')->name('organizer.categoriezedCompetitions.create');
    Route::post('organizer/competitions/{competition}/categoriezed_competitions/store', 'App\Http\Controllers\Organizer\OrganizerCategoriezedCompetitionController@store')->name('organizer.categoriezedCompetitions.store');
    //【管理画面】階級別大会
    Route::get('organizer/competitions/{competition}/{categoriezedCompetition}/classfied_competitions/create', 'App\Http\Controllers\Organizer\OrganizerClassfiedCompetitionController@create')->name('organizer.classfiedCompetitions.create');
    Route::post('organizer/competitions/{competition}/{categoriezedCompetition}/classfied_competitions/store', 'App\Http\Controllers\Organizer\OrganizerClassfiedCompetitionController@store')->name('organizer.classfiedCompetitions.store');
    //【管理画面】ラウンド
    Route::get('organizer/competitions/{classfiedCompetition}/rounds', 'App\Http\Controllers\Organizer\OrganizerRoundController@index')->name('organizer.rounds.index');
    Route::get('organizer/competitions/{classfiedCompetition}/rounds/create', 'App\Http\Controllers\Organizer\OrganizerRoundController@create')->name('organizer.rounds.create');
    Route::post('organizer/competitions/{classfiedCompetition}/rounds/store', 'App\Http\Controllers\Organizer\OrganizerRoundController@store')->name('organizer.rounds.store');

    Route::delete('organizer/competitions/rounds/{round}/destroy', 'App\Http\Controllers\Organizer\OrganizerRoundController@destroy')->name('organizer.rounds.destroy');
    //【管理画面】カテゴリ・スタイル・階級
    Route::get('organizer/competitions/{competition}/style_class/create', 'App\Http\Controllers\Organizer\OrganizerCompetitionStyleClassController@create')->name('organizer.competitionStyleClasses.create');
    Route::post('organizer/competitions/{competition}/style_class/store', 'App\Http\Controllers\Organizer\OrganizerCompetitionStyleClassController@store')->name('organizer.competitionStyleClasses.store');
    //【管理画面】大会の選手登録画面
    Route::get('organizer/competitions/{classfiedCompetition}/players/', 'App\Http\Controllers\Organizer\OrganizerClassfiedCompetitionPlayerController@index')->name('organizer.classfiedCompetitionPlayers.index');
    Route::get('organizer/competitions/{classfiedCompetition}/players/create', 'App\Http\Controllers\Organizer\OrganizerClassfiedCompetitionPlayerController@create')->name('organizer.classfiedCompetitionPlayers.create');
    Route::post('organizer/competitions/{classfiedCompetition}/players/store', 'App\Http\Controllers\Organizer\OrganizerClassfiedCompetitionPlayerController@store')->name('organizer.classfiedCompetitionPlayers.store');

    //【管理画面】試合
    Route::get('organizer/competitions/{competition_id}/games/index', 'App\Http\Controllers\Organizer\OrganizerGameController@index')->name('organizer.games.index');
    Route::get('organizer/competitions/{round}/games/create', 'App\Http\Controllers\Organizer\OrganizerGameController@create')->name('organizer.games.create');
    Route::post('organizer/competitions/{round}/games/store', 'App\Http\Controllers\Organizer\OrganizerGameController@store')->name('organizer.games.store');
    Route::get('organizer/competitions/{game}/games/edit', 'App\Http\Controllers\Organizer\OrganizerGameController@edit')->name('organizer.games.edit');
    Route::put('organizer/competitions/{game}/games/update', 'App\Http\Controllers\Organizer\OrganizerGameController@update')->name('organizer.games.update');
    Route::delete('organizer/game/{game}/destroy', 'App\Http\Controllers\Organizer\OrganizerGameController@destroy')->name('organizer.games.destroy');
    //【管理画面】大会スケジュール
    Route::get('organizer/competitions/{competition}/rounds/{round}/schedule/create', 'App\Http\Controllers\Organizer\OrganizerCompetitionScheduleController@create')->name('organizer.schedules.create');
    Route::post('organizer/competitions/{competition}/rounds/{round}/schedule/store', 'App\Http\Controllers\Organizer\OrganizerCompetitionScheduleController@store')->name('organizer.schedules.store');
    Route::get('organizer/competitions/{competition}/mat/{mat}/schedule', 'App\Http\Controllers\Organizer\OrganizerCompetitionScheduleController@index')->name('organizer.schedules.index');
    //【管理画面】マット別試合順
    Route::get('organizer/competitions/{competition}/match_order', 'App\Http\Controllers\Organizer\OrganizerCompetitionScheduleController@matchOrderIndex')->name('organizer.matchOrder.index');
    //【管理画面】スコアシート
    Route::get('organizer/competitions/games/{game}/scoresheets/create', 'App\Http\Controllers\Organizer\OrganizerScoresheetController@create')->name('organizer.scoresheets.create');
    Route::post('organizer/competitions/games/{game}/scoresheets/store', 'App\Http\Controllers\Organizer\OrganizerScoresheetController@store')->name('organizer.scoresheets.store');
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
    Route::get('organizer/competitions/{competition_id}/mats/create', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@matsCreate')->name('organizer.mats.create');
    Route::post('organizer/competitions/{competition_id}/mats/store', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@matsStore')->name('organizer.mats.store');
    Route::get('organizer/competitions/{competition}/mats//{mat}/edit', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@matsEdit')->name('organizer.mats.edit');
    Route::put('organizer/competitions/{competition}/mats/{mat}/update', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@matsUpdate')->name('organizer.mats.update');
    Route::delete('organizer/competitions/{competition}/mats/{mat}/destroy', 'App\Http\Controllers\Organizer\OrganizerCompetitionController@matsDestroy')->name('organizer.mats.destroy');
    //【管理画面】トップページ
    Route::get('organizer/index', 'App\Http\Controllers\Organizer\OrganizerController@index')->name('organizer.index');
});
//【ユーザー】大会一覧ページ
Route::get('competitions/index', 'App\Http\Controllers\User\CompetitionController@index')->name('users.competitions.index');
//【ユーザー】大会詳細画面
Route::get('competition/{competition}/category/{categoriezedCompetition}/index', 'App\Http\Controllers\User\CategoriezedCompetitionController@index')->name('users.categoriezedCompetition.index');
//【ユーザー】大会別出場選手一覧ページ
Route::get('competition/{competition}/category/{categoriezedCompetition}/class/{classfiedCompetition}/players', 'App\Http\Controllers\User\ClassfiedCompetitionPlayerController@index')->name('users.classfiedCompetitionPlayers.index');
Route::post('competition/{competition}/category/{categoriezedCompetition}/class/{classfiedCompetition}/players/favorite/{playerId}', 'App\Http\Controllers\User\ClassfiedCompetitionPlayerController@favorite')->name('users.classfiedCompetitionPlayers.favorite');
//【ユーザー】大会スケジュールページ
Route::get('competition/{competition}/mat/{mat}/schedule', 'App\Http\Controllers\User\CompetitionScheduleController@index')->name('users.competitionSchedules.index');
//【ユーザー】マット別試合順
Route::get('competition/{competition}/match_order', 'App\Http\Controllers\User\CompetitionMatchOrderController@index')->name('users.matchOrders.index');

//【ユーザー】スコアシート
Route::get('competition/{competition}/category/{categoriezedCompetition}/class/{classfiedCompetition}/game/{game}/scoresheet', 'App\Http\Controllers\User\ScoresheetController@show')->name('users.scoresheets.show');

Route::get('competitions/{competition}/show', 'App\Http\Controllers\User\CompetitionController@show')->name('users.competitions.show');
Route::post('competitions/{competition}/category/{categoriezedCompetition}/index/favorite', 'App\Http\Controllers\User\CategoriezedCompetitionController@favorite')->name('users.categoriezedCompetitions.favorite');
Route::delete('competitions/{competition}/category/{categoriezedCompetition}/unfavorite', 'App\Http\Controllers\User\CategoriezedCompetitionController@unfavorite')->name('users.categoriezedCompetitions.unfavorite');
//【ユーザー】お気に入り選手情報
Route::get('favorite_player_games/{player}', 'App\Http\Controllers\User\PlayerController@favoritePlayerGames')->name('users.favoritePlayerGames.index');
//【ユーザー】マイページ
Route::get('users/mypage', 'App\Http\Controllers\User\UserController@index')->name('users.users.index');
//【ユーザー】マイページ（通知登録中の選手一覧）
// Route::get('users/{user}/notify_players', 'App\Http\Controllers\User\UserController@notifyPlayers')->name('users.users.notify-players');
//【ユーザー】各ユーザーのお気に入り大会一覧ページ
// Route::get('users/{user}/mypage/favorites', 'App\Http\Controllers\User\UserController@favorites')->name('users.users.favorites');
//【ユーザー】マット別試合順ページ
Route::get('competitions/{competition_id}/games', 'App\Http\Controllers\User\GameController@index')->name('users.games.index');

//【ユーザー】通知設定画面
// Route::get('competitions/{competition}/notify_player/{classfiedCompetitionPlayer}/create', 'App\Http\Controllers\User\NotifyPlayerController@create')->name('users.notifyPlayers.create');
// Route::post('competitions/{competition}/notify_player/{classfiedCompetitionPlayer}/store', 'App\Http\Controllers\User\NotifyPlayerController@store')->name('users.notifyPlayers.store');
//【ユーザー】選手一覧
Route::get('players', 'App\Http\Controllers\User\PlayerController@index')->name('users.players.index');

//【ユーザー】お気に入り選手一覧
Route::post('players/{player}/favorite', 'App\Http\Controllers\User\PlayerController@favorite')->name('users.players.favorite');
//【ユーザー】マイページお気に入り登録中の選手
Route::get('users/mypage/favorite_players', 'App\Http\Controllers\User\UserController@favoritePlayers')->name('users.users.favoritePlayers');

//roleで役割を振り分ける（middleware)→ログイン・非ログインユーザーで分ける
Route::get('/admin', 'AdminController@index')->name('admin');

// お気に入り機能
Route::middleware(['auth'])->group(function () {
    Route::resource('classfied_competition_player', ClassfiedCompetitionPlayerController::class);
    Route::post('favorites/{classfied_competition_player_id}', [UserFavoriteController::class, 'store'])->name('user.favorites.store');
    Route::delete('favorites/{classfied_competition_player_id}', [UserFavoriteController::class, 'destroy'])->name('user.favorites.destroy');
});
