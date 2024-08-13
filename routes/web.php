<?php

use Illuminate\Http\Request;
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
})->name('login');

Route::get('/chooseCompany-Well', function () {
    return view('page.dashboard-user.company-well');
});

Route::get('/dashboard', function () {
    return view('page.dashboard-user.dashboard');
});

Route::get('/history', function () {
    return view('page.dashboard-user.history');
});

Route::prefix('admin')->group(function () {
    Route::prefix('company')->group(function () {
        Route::get('/', function () {
            return view('page.dashboard-admin.company.getCompany');
        });
        Route::get('/add', function () {
            return view('page.dashboard-admin.company.addCompany');
        });
        Route::get('/edit', function () {
            return view('page.dashboard-admin.company.editCompany');
        });
    });

    Route::prefix('employee')->group(function () {
        Route::get('/', function () {
            return view('page.dashboard-admin.employee.getEmployee');
        });
        Route::get('/add', function () {
            return view('page.dashboard-admin.employee.addEmployee');
        });
        Route::get('/edit', function () {
            return view('page.dashboard-admin.employee.editEmployee');
        });
    });

    Route::prefix('place')->group(function () {
        Route::get('/', function () {
            return view('page.dashboard-admin.place.getPlace');
        });
        Route::get('/add', function () {
            return view('page.dashboard-admin.place.addPlace');
        });
        Route::get('/edit', function () {
            return view('page.dashboard-admin.place.editPlace');
        });
    });

    Route::prefix('well')->group(function () {
        Route::get('/', function () {
            return view('page.dashboard-admin.well.getWell');
        });
        Route::get('/add', function () {
            return view('page.dashboard-admin.well.addWell');
        });
        Route::get('/edit', function () {
            return view('page.dashboard-admin.well.editWell');
        });
    });

    Route::prefix('rig')->group(function () {
        Route::get('/', function () {
            return view('page.dashboard-admin.rig.getRig');
        });
        Route::get('/add', function () {
            return view('page.dashboard-admin.rig.addRig');
        });
        Route::get('/edit', function () {
            return view('page.dashboard-admin.rig.editRig');
        });
    });
});
