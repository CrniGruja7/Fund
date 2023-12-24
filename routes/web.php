<?php

use App\Http\Controllers\FundController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [FundController::class, 'index'])->name('welcome')->middleware('guest');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/home/favorites', [App\Http\Controllers\HomeController::class, 'favorites'])->name('favorites')->middleware('auth');
Route::get('/home/generate-pdf/{id}', [App\Http\Controllers\HomeController::class, 'generatePdf'])->name('generatePdf')->middleware('auth');
Route::get('/home/generate-xlsx/{id}', [App\Http\Controllers\HomeController::class, 'generateXlsx'])->name('generateXlsx')->middleware('auth');
Route::get('/home/generate-xml/{id}', [App\Http\Controllers\HomeController::class, 'generateXml'])->name('generateXml')->middleware('auth');


Route::delete('/home/remove/{id}', [App\Http\Controllers\HomeController::class, 'remove'])->name('remove')->middleware('auth');
Route::post('/home/favorites/{id}', [App\Http\Controllers\HomeController::class, 'favoritesAdd'])->name('favoritesAdd')->middleware('auth');




