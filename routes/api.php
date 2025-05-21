<?php

use App\Http\Controllers\Api\Auth\JoinController;
use App\Models\Api\Core\Wilaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return response()->json([
        "message" => "hello",
        "user" => $request->user()->load('key.keyable.photo')
    ]);
});

Route::middleware('guest.sanctum')->group(function () {
    Route::post('/register', [JoinController::class, 'register']);
    Route::post('/login', [JoinController::class, 'login']);
    Route::get('wilayas',function(){
        $wilayas = Wilaya::with('baladiyas')->get();
        return response()->json([
            'message' => 'Wilayas fetched successfully',
            'wilayas' => $wilayas
        ], 200);
    });
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::match(['get', 'post'], '/logout', [JoinController::class, 'logout']);

    // Core Routes
    Route::apiResource('wilayas', \App\Http\Controllers\Api\Core\WilayaController::class);
    Route::apiResource('baladiyas', \App\Http\Controllers\Api\Core\BaladiyaController::class);
    Route::apiResource('specialities', \App\Http\Controllers\Api\Core\SpecialityController::class);

    //================================================//
    // Users Routes

    // Admins Routes
    Route::apiResource('admins', \App\Http\Controllers\Api\Users\AdminController::class);
    Route::post('admins/{admin}/generate-key', [\App\Http\Controllers\Api\Users\AdminController::class, 'createKey']);


    // Doctors Routes
    Route::apiResource('doctors', \App\Http\Controllers\Api\Users\DoctorController::class);

    // Pharmacies Routes
    Route::apiResource('pharmacies', \App\Http\Controllers\Api\Users\PharmacyController::class);

    // Patients Routes
    Route::apiResource('patients', \App\Http\Controllers\Api\Users\PatientController::class);
    Route::post('patients/{patient}/generate-key', [\App\Http\Controllers\Api\Users\PatientController::class, 'createKey']);

    Route::apiResource('doctor-helpers', \App\Http\Controllers\Api\Users\DoctorHelperController::class);

    //================================================//
    // Main Routes

    Route::apiResource('queues', \App\Http\Controllers\Api\Main\QueueController::class);
    Route::apiResource('prescriptions', \App\Http\Controllers\Api\Main\PrescriptionController::class);
    Route::apiResource('messages', \App\Http\Controllers\Api\Main\MessageController::class);
});




require __DIR__ . '/auth.php';
