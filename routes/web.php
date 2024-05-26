<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\WellController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('real-time-chart', 'charts.realTime-Chart');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/chart-js', function () {
    return view('chart-js');
});
Route::get('/homepage', function () {
    return view('homepage');
});
Route::get('/coba', function () {
    return view('coba');
});
Route::get('/coba', function () {
    return view('coba');
});
