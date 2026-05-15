<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FireStationController;
use App\Http\Controllers\InterventionTypeController;
use App\Http\Controllers\InterventionRecordController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\FirefighterController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\VehicleController;

// Fire Stations Routes
Route::get('/', [FireStationController::class, 'index']);
Route::get('/fireStations', [FireStationController::class, 'index']);
Route::get('/fireStations/{id}/edit', [FireStationController::class, 'formModifyFireStation']);
Route::post('/fireStations/add', [FireStationController::class, 'add']);
Route::put('/fireStations/{id}/update', [FireStationController::class, 'update']);
Route::delete('/fireStations/{id}/delete', [FireStationController::class, 'delete']);
Route::delete('/fireStations/clear', [FireStationController::class, 'clear']);

// Intervention Types Routes
Route::get('/intervention-types', [InterventionTypeController::class, 'index']);
Route::post('/intervention-types/add', [InterventionTypeController::class, 'add']);
Route::get('/intervention-types/{id}/edit', [InterventionTypeController::class, 'formModify']);
Route::put('/intervention-types/{id}/update', [InterventionTypeController::class, 'update']);
Route::delete('/intervention-types/{id}/delete', [InterventionTypeController::class, 'delete']);
Route::delete('/intervention-types/clear', [InterventionTypeController::class, 'clear']);

// Intervention Records Routes
Route::get('/intervention-records', [InterventionRecordController::class, 'index']);
Route::get('/intervention-records/by-station/{fireStationId}', [InterventionRecordController::class, 'index']);
Route::post('/intervention-records/add', [InterventionRecordController::class, 'add']);
Route::get('/intervention-records/{id}/view', [InterventionRecordController::class, 'open']);
Route::get('/intervention-records/{id}/edit', [InterventionRecordController::class, 'formModify']);
Route::put('/intervention-records/{id}/update', [InterventionRecordController::class, 'update']);
Route::delete('/intervention-records/{id}/delete', [InterventionRecordController::class, 'delete']);
Route::delete('/intervention-records/clear', [InterventionRecordController::class, 'clear']);

// Grades Routes
Route::get('/grades', [GradeController::class, 'index']);
Route::post('/grades/add', [GradeController::class, 'add']);
Route::delete('/grades/{id}/delete', [GradeController::class, 'delete']);
Route::delete('/grades/clear', [GradeController::class, 'clear']);

// Firefighters Routes
Route::get('/firefighters', [FirefighterController::class, 'index']);
Route::post('/firefighters/add', [FirefighterController::class, 'add']);
Route::get('/firefighters/{id}/edit', [FirefighterController::class, 'formModify']);
Route::put('/firefighters/{id}/update', [FirefighterController::class, 'update']);
Route::delete('/firefighters/{id}/delete', [FirefighterController::class, 'delete']);
Route::delete('/firefighters/clear', [FirefighterController::class, 'clear']);

// Vehicle Types Routes
Route::get('/vehicle-types', [VehicleTypeController::class, 'index']);
Route::post('/vehicle-types/add', [VehicleTypeController::class, 'add']);
Route::get('/vehicle-types/{id}/edit', [VehicleTypeController::class, 'formModify']);
Route::put('/vehicle-types/{id}/update', [VehicleTypeController::class, 'update']);
Route::delete('/vehicle-types/{id}/delete', [VehicleTypeController::class, 'delete']);
Route::delete('/vehicle-types/clear', [VehicleTypeController::class, 'clear']);

// Vehicles Routes
Route::get('/vehicles', [VehicleController::class, 'index']);
Route::post('/vehicles/add', [VehicleController::class, 'add']);
Route::get('/vehicles/{id}/edit', [VehicleController::class, 'formModify']);
Route::put('/vehicles/{id}/update', [VehicleController::class, 'update']);
Route::delete('/vehicles/{id}/delete', [VehicleController::class, 'delete']);
Route::delete('/vehicles/clear', [VehicleController::class, 'clear']);
