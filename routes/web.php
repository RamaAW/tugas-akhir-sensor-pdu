<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\About;
use App\Livewire\Records\Chart;
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
Route::get('/login', function () {
    return view('login');
});

Route::get('/chooseCompany-Well', function () {
    return view('company-well');
});

Route::get('/homepage', function () {
    return view('homepage');
});

Route::get('/homepage-home', function () {
    return view('homepage-backup');
});

Route::get('/coba', function () {
    return view('coba');
});

#Livewire
Route::get('/records', Chart::class)->name('records.chart');
