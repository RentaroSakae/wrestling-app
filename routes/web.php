<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\Competition_CategoryController;

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
//Route::delete('/competitions/{competition}', 'CompetitionController@destroy')->name('competitions.destroy');
Route::get('competitions/{id}/mats', 'App\Http\Controllers\CompetitionController@showMats')->name('competitions.mats');
Route::get('admin/competitions/create', 'App\Http\Controllers\CompetitionController@create')->name('admin.competitions.create');
Route::resource('competitions.competition_categories', Competition_CategoryController::class)->only(['store']);




