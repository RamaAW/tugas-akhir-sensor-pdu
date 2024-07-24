<?php

use Illuminate\Support\Facades\Route;
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
    return view('page.login');
})->name('login')->middleware('checkToken');

Route::get('/chooseCompany-Well', function () {
    return view('page.dashboard-user.company-well');
});

Route::get('/dashboard', function () {
    return view('page.dashboard-user.homepage-backup');
});

Route::get('/homepage', function () {
    return view('page.dashboard-user.homepage');
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('page.dashboard-admin.company.getCompany');
    });
    Route::get('/addCompany', function () {
        return view('page.dashboard-admin.company.addCompany');
    });
    Route::get('/editCompany', function () {
        return view('page.dashboard-admin.company.editCompany');
    });

    Route::get('/employee', function () {
        return view('page.dashboard-admin.employee.getEmployee');
    });
    Route::get('/addEmployee', function () {
        return view('page.dashboard-admin.employee.addEmployee');
    });
    Route::get('/editEmployee', function () {
        return view('page.dashboard-admin.employee.editEmployee');
    });
});
