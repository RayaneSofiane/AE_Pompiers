<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FireStationController;

Route::get('/', [FireStationController::class, 'index']);
Route::get('/fireStations', [FireStationController::class, 'index']);
Route::get('/fireStations/{id}/edit', [FireStationController::class, 'formModifyFireStation']);
Route::post('/fireStations/add', [FireStationController::class, 'add']);
Route::put('/fireStations/{id}/update', [FireStationController::class, 'update']);
Route::delete('/fireStations/{id}/delete', [FireStationController::class, 'delete']);
Route::delete('/fireStations/clear', [FireStationController::class, 'clear']);
