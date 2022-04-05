<?php

use App\Http\Controllers\WordController;
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

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/words', [WordController::class, "index"])->name('words');
Route::get('/words/filters', [WordController::class, "getByFiltersSelected"])->name('words.filters');
Route::get('/words/search', [WordController::class, "searchWords"])->name('words.search');

Route::post('/words', [WordController::class, "store"])->name('words.add');
Route::post('/words/update', [WordController::class, "update"])->name('words.update');
Route::delete('/words/{word}', [WordController::class, "delete"])->name('words.delete');