<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\AnggotaListController;
use App\Http\Controllers\AnggotaEditController;
use App\Http\Controllers\AnggotaNewController;

use App\Http\Controllers\KeluargaListController;
use App\Http\Controllers\KeluargaEditController;
use App\Http\Controllers\KeluargaNewController;

use App\Http\Controllers\myProfileController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});


Route::get('/anggotaList', [AnggotaListController::class, 'index'])->name('anggotaList');
Route::get('/anggotaList/search/', [AnggotaListController::class, 'search'])->name('search');
Route::get('/anggotaDelete/{id}', [AnggotaListController::class, 'delete'])->name('anggotaDelete');

Route::get('/anggotaNew', [AnggotaNewController::class, 'index'])->name('anggotaNew');
Route::post('addAnggota', [AnggotaNewController::class, 'add'])->name('addAnggota');
Route::post('file-import', [AnggotaNewController::class, 'fileImport'])->name('file-import');

Route::get('/anggotaEdit/{id}', [AnggotaEditController::class, 'superadmin'])->name('anggotaEdit');
Route::get('/myData', [AnggotaEditController::class, 'user'])->name('myData');
Route::post('editAnggota', [AnggotaEditController::class, 'edit'])->name('editAnggota');

Route::get('/keluargaList', [KeluargaListController::class, 'index'])->name('keluargaList');
Route::get('/keluargaList/search/', [KeluargaListController::class, 'search'])->name('search');
Route::get('/keluargaDelete/{id}', [KeluargaListController::class, 'delete'])->name('keluargaDelete');

Route::get('/keluargaNew', [KeluargaNewController::class, 'index'])->name('keluargaNew');
Route::post('addKeluarga', [KeluargaNewController::class, 'add'])->name('addKeluarga');

Route::get('/keluargaEdit/{id}', [KeluargaEditController::class, 'superadmin'])->name('keluargaEdit');
Route::get('/myFamily', [KeluargaEditController::class, 'user'])->name('myFamily');
Route::post('editKeluarga', [KeluargaEditController::class, 'edit'])->name('editKeluarga');
;



// Route::get('/myProfile', [myProfileController::class, 'index'])->name('myProfile');