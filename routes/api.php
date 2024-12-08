<?php

use App\Http\Controllers\Api\LocationController;
use App\Models\Destination;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PackageController;

Route::middleware(['api', 'throttle:api'])->group(function () {
    // Route::get('/hotels-by-destination/{destinationId}', [PackageController::class, 'getHotelsByDestination']);
    Route::get('/hotels-by-destination/{destinationId}', function ($destinationId) {
        $destination = Destination::with('location')->findOrFail($destinationId);
    
        // Dapatkan hotels berdasarkan lokasi destinasi
        $hotels = \App\Models\Hotel::where('location_id', $destination->location_id)->get();
    
        return response()->json($hotels);
    });
    Route::get('/transportations-by-destination/{destinationId}', [PackageController::class, 'getTransportationsByDestination']);


    Route::resource('/locations', LocationController::class);
});
?>