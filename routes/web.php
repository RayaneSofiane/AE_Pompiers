<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FireStationController;
use App\Http\Controllers\InterventionTypeController;
use App\Http\Controllers\InterventionRecordController;

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
