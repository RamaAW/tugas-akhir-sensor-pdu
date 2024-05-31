<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WellController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmployeeAuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RecordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [EmployeeAuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    //yang sementara dipakai

    //employee
    Route::get('employees', [EmployeeController::class, 'index'])->middleware('role:user,admin,superAdmin');
    Route::get('employee/{id}', [EmployeeController::class, 'show'])->middleware('role:user,admin,superAdmin');
    Route::post('employee', [EmployeeController::class, 'store'])->middleware('role:admin,superAdmin');
    Route::post('/company/{companyId}/employee', [CompanyController::class, 'addEmployee'])->middleware('role:admin,superAdmin');;

    //company
    Route::get('companies', [CompanyController::class, 'index'])->middleware('role:user,admin,superAdmin');
    Route::get('company/{id}', [CompanyController::class, 'show'])->middleware('role:user,admin,superAdmin');
    Route::post('company', [CompanyController::class, 'store'])->middleware('role:superAdmin');

    //place
    Route::post('company/{companyId}/place', [CompanyController::class, 'createPlace'])->middleware('role:admin,superAdmin');
    Route::get('places', [PlaceController::class, 'index'])->middleware('role:user,admin,superAdmin');
    Route::get('place/{id}', [PlaceController::class, 'show'])->middleware('role:user,admin,superAdmin');

    //well
    Route::post('company/{companyId}/place/{placeId}/well', [PlaceController::class, 'createWell'])->middleware('role:admin,superAdmin');
    Route::get('wells', [WellController::class, 'index'])->middleware('role:user,admin,superAdmin');
    Route::get('well/{id}', [WellController::class, 'show'])->middleware('role:user,admin,superAdmin');

    //yang sementara tidak dipakai (possible for delete)
    Route::put('employees/{id}', [EmployeeController::class, 'update'])->middleware('role:admin,superAdmin');
    Route::delete('employees/{id}', [EmployeeController::class, 'destroy'])->middleware('role:admin,superAdmin');

    Route::put('company/{id}', [CompanyController::class, 'update'])->middleware('role:admin,superAdmin');
    Route::delete('company/{id}', [CompanyController::class, 'destroy'])->middleware('role:superAdmin');

    Route::post('places', [PlaceController::class, 'store'])->middleware('role:admin,superAdmin');
    Route::put('places/{id}', [PlaceController::class, 'update'])->middleware('role:admin,superAdmin');
    Route::delete('places/{id}', [PlaceController::class, 'destroy'])->middleware('role:admin,superAdmin');

    Route::get('records', [RecordController::class, 'index'])->middleware('role:user,admin,superAdmin');
    Route::get('records/{id}', [RecordController::class, 'show'])->middleware('role:user,admin,superAdmin');
    Route::delete('records/{id}', [RecordController::class, 'destroy'])->middleware('role:admin,superAdmin');

    Route::post('wells', [WellController::class, 'store'])->middleware('role:admin,superAdmin');
    Route::put('wells/{id}', [WellController::class, 'update'])->middleware('role:admin,superAdmin');
    Route::delete('wells/{id}', [WellController::class, 'destroy'])->middleware('role:admin,superAdmin');

    Route::get('notifications', [NotificationController::class, 'index'])->middleware('role:user,admin,superAdmin');
    Route::get('notifications/{id}', [NotificationController::class, 'show'])->middleware('role:user,admin,superAdmin');
    Route::put('notifications/{id}', [NotificationController::class, 'update'])->middleware('role:admin,superAdmin');
    Route::delete('notifications/{id}', [NotificationController::class, 'destroy'])->middleware('role:admin,superAdmin');
});
Route::post('records', [RecordController::class, 'store']);
Route::post('notifications', [NotificationController::class, 'store']);
Route::post('generate-dummy-record', [RecordController::class, 'generateDummyRecord']);

Route::post('/logout', [EmployeeAuthController::class, 'logout'])->middleware('auth:sanctum');
