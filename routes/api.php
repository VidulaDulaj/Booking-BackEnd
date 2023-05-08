<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('appointment')->group(function() {
    Route::get('/', [AppointmentController::class, 'index']);
    Route::post('booking', [AppointmentController::class, 'makeAppointment']);
    Route::get('available_bookings/{doctorId}', [AppointmentController::class, 'availableBookings']);
});

Route::prefix('doctor')->group(function() {
    Route::get('all', [DoctorController::class, 'getDoctors']);
});