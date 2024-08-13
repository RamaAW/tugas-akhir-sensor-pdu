<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WellController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CsvUploadController;
use App\Http\Controllers\EmployeeAuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\RigController;

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
    Route::get('employees', [EmployeeController::class, 'index'])->middleware('role:user,admin');
    Route::get('employee/{id}', [EmployeeController::class, 'show'])->middleware('role:user,admin');
    Route::post('employee', [EmployeeController::class, 'store'])->middleware('role:admin');
    // Route::post('/company/{companyId}/employee', [CompanyController::class, 'addEmployee'])->middleware('role:admin');;
    Route::put('employee/{id}', [EmployeeController::class, 'update'])->middleware('role:admin');
    Route::delete('employee/{id}', [EmployeeController::class, 'destroy'])->middleware('role:admin');

    //company
    Route::get('companies', [CompanyController::class, 'index'])->middleware('role:user,admin');
    Route::get('company/{id}', [CompanyController::class, 'show'])->middleware('role:user,admin');
    Route::get('companies-for-employee', [CompanyController::class, 'getCompaniesForEmployee'])->middleware('role:user,admin');
    Route::post('company', [CompanyController::class, 'store'])->middleware('role:admin');
    Route::put('company/{id}', [CompanyController::class, 'update'])->middleware('role:admin');
    Route::delete('company/{id}', [CompanyController::class, 'destroy'])->middleware('role:admin');

    //place
    Route::post('company/{companyId}/place', [CompanyController::class, 'createPlace'])->middleware('role:admin');
    Route::get('places', [PlaceController::class, 'index'])->middleware('role:user,admin');
    Route::get('place/{id}', [PlaceController::class, 'show'])->middleware('role:user,admin');
    Route::post('places', [PlaceController::class, 'store'])->middleware('role:admin');
    Route::put('place/{id}', [PlaceController::class, 'update'])->middleware('role:admin');
    Route::delete('place/{id}', [PlaceController::class, 'destroy'])->middleware('role:admin');

    //well
    Route::post('company/{companyId}/place/{placeId}/well', [PlaceController::class, 'createWell'])->middleware('role:admin');
    Route::get('wells', [WellController::class, 'index'])->middleware('role:user,admin');
    Route::get('well/{id}', [WellController::class, 'show'])->middleware('role:user,admin');
    Route::get('/companies/{companyId}/wells', [WellController::class, 'showByCompanyId'])->middleware('role:user,admin');
    Route::get('/companies/{companyId}/places/{placeId?}', [WellController::class, 'showByPlaceId'])->middleware('role:user,admin');

    Route::post('wells', [WellController::class, 'store'])->middleware('role:admin');
    Route::put('well/{id}', [WellController::class, 'update'])->middleware('role:admin');
    Route::delete('well/{id}', [WellController::class, 'destroy'])->middleware('role:admin');

    //rig
    Route::post('rig', [RigController::class, 'store'])->middleware('role:admin');
    Route::get('rigs', [RigController::class, 'index'])->middleware('role:user,admin');
    Route::get('rig/{id}', [RigController::class, 'show'])->middleware('role:user,admin');
    Route::get('rig/well/{wellId}', [RigController::class, 'showByWellId'])->middleware('role:user,admin');
    Route::put('rig/{id}', [RigController::class, 'update'])->middleware('role:admin');
    Route::delete('rig/{id}', [RigController::class, 'destroy'])->middleware('role:admin');

    //record
    Route::get('records', [RecordController::class, 'index'])->middleware('role:user,admin');
    Route::get('records/{id}', [RecordController::class, 'show'])->middleware('role:user,admin');
    Route::get('records/rig/{rigId}/getLast30', [RecordController::class, 'getLastRecords'])->middleware('role:user,admin');
    Route::get('records/rig/{rigId}', [RecordController::class, 'showByRigId'])->middleware('role:user,admin');
    Route::get('records/well/{wellId}', [RecordController::class, 'showByWellId'])->middleware('role:user,admin');
    Route::delete('records/{id}', [RecordController::class, 'destroy'])->middleware('role:admin');
    Route::delete('/records/rig/{rigId}', [RecordController::class, 'destroyByRig'])->middleware('role:admin');
    Route::post('records/uploadCsv', [RecordController::class, 'uploadCsv'])->middleware('role:admin');

    //notification
    Route::get('notifications', [NotificationController::class, 'index'])->middleware('role:user,admin');
    Route::get('notification/{id}', [NotificationController::class, 'show'])->middleware('role:user,admin');
    Route::get('notification/rig/{rigId}', [NotificationController::class, 'getNotificationByRigId'])->middleware('role:user,admin');
    Route::put('notification/{id}', [NotificationController::class, 'update'])->middleware('role:admin');
    Route::delete('notification/{id}', [NotificationController::class, 'destroy'])->middleware('role:admin');

    Route::post('records', [RecordController::class, 'store'])->middleware('role:user,admin');
    Route::get('records/save-csv/{rigId}', [RecordController::class, 'saveCsv'])->name('save.csv')->middleware('role:user,admin');
    Route::get('records/save-csv-byTime/{rigId}', [RecordController::class, 'saveCsvByTime'])->name('saveByTime.csv')->middleware('role:admin,user');
    Route::post('notification', [NotificationController::class, 'store'])->middleware('role:user,admin');
});
Route::post('/logout', [EmployeeAuthController::class, 'logout'])->middleware('auth:sanctum');
