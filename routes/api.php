<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
	UserController,
	RateController,
	CenterController,
	BookingController,
	VehicleController,
	CustomerController,
	LocationController,
	PositionController,
	TravelTypeController,
	VehicleTypeController,
	VehicleGroupController,
	SupplyCenterController,
	FuelConsumptionController,
};

Route::get('/bookings', [BookingController::class, 'index']);
Route::prefix('/booking')->group(function() {
	Route::post('/store', [BookingController::class, 'store']);
	Route::put('/{id}', [BookingController::class, 'update']);
	Route::delete('/{id}', [BookingController::class, 'destroy']);
});

Route::get('/centers', [CenterController::class, 'index']);
Route::prefix('/center')->group(function() {
	Route::post('/store', [CenterController::class, 'store']);
	Route::put('/{id}', [CenterController::class, 'update']);
	Route::delete('/{id}', [CenterController::class, 'destroy']);
});

Route::get('/fuel-consumptions', [FuelConsumptionController::class, 'index']);
Route::prefix('/fuel-consumption')->group(function() {
    Route::get('/dashboard', [FuelConsumptionController::class, 'dashboard']);
    Route::get('/{id}', [FuelConsumptionController::class, 'show']);
	Route::post('/store', [FuelConsumptionController::class, 'store']);
	Route::put('/{id}', [FuelConsumptionController::class, 'update']);
	Route::delete('/{id}', [FuelConsumptionController::class, 'destroy']);
});

Route::get('/locations', [LocationController::class, 'index']);
Route::prefix('/location')->group(function() {
	Route::post('/store', [LocationController::class, 'store']);
	Route::put('/{id}', [LocationController::class, 'update']);
	Route::delete('/{id}', [LocationController::class, 'destroy']);
});

Route::get('/positions', [PositionController::class, 'index']);
Route::prefix('/position')->group(function() {
	Route::post('/store', [PositionController::class, 'store']);
	Route::put('/{id}', [PositionController::class, 'update']);
	Route::delete('/{id}', [PositionController::class, 'destroy']);
});

Route::get('/rates', [RateController::class, 'index']);
Route::prefix('/rate')->group(function() {
	Route::post('/store', [RateController::class, 'store']);
	Route::put('/{id}', [RateController::class, 'update']);
	Route::delete('/{id}', [RateController::class, 'destroy']);
});

Route::get('/supply-centers', [SupplyCenterController::class, 'index']);
Route::prefix('/supply-center')->group(function() {
	Route::post('/store', [SupplyCenterController::class, 'store']);
	Route::put('/{id}', [SupplyCenterController::class, 'update']);
	Route::delete('/{id}', [SupplyCenterController::class, 'destroy']);
});

Route::get('/travel-types', [TravelTypeController::class, 'index']);
Route::prefix('/travel-type')->group(function() {
	Route::post('/store', [TravelTypeController::class, 'store']);
	Route::put('/{id}', [TravelTypeController::class, 'update']);
	Route::delete('/{id}', [TravelTypeController::class, 'destroy']);
});

Route::get('/users', [UserController::class, 'index']);
Route::prefix('/user')->group(function() {
	Route::post('/store', [UserController::class, 'store']);
	Route::put('/{id}', [UserController::class, 'update']);
	Route::delete('/{id}', [UserController::class, 'destroy']);
});

Route::get('/customers', [CustomerController::class, 'index']);
Route::prefix('/customer')->group(function() {
	Route::post('/store', [CustomerController::class, 'store']);
	Route::put('/{id}', [CustomerController::class, 'update']);
	Route::delete('/{id}', [CustomerController::class, 'destroy']);
});

Route::get('/vehicles', [VehicleController::class, 'index']);
Route::prefix('/vehicle')->group(function() {
	Route::post('/store', [VehicleController::class, 'store']);
	Route::put('/{id}', [VehicleController::class, 'update']);
	Route::delete('/{id}', [VehicleController::class, 'destroy']);
});

Route::get('/vehicle-groups', [VehicleGroupController::class, 'index']);
Route::prefix('/vehicle-group')->group(function() {
	Route::post('/store', [VehicleGroupController::class, 'store']);
	Route::put('/{id}', [VehicleGroupController::class, 'update']);
	Route::delete('/{id}', [VehicleGroupController::class, 'destroy']);
});

Route::get('/vehicle-types', [VehicleTypeController::class, 'index']);
Route::prefix('/vehicle-type')->group(function() {
	Route::post('/store', [VehicleTypeController::class, 'store']);
	Route::put('/{id}', [VehicleTypeController::class, 'update']);
	Route::delete('/{id}', [VehicleTypeController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
