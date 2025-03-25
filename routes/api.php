<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ImageApiController;
// Get all images
Route::get('/images', [ImageApiController::class, 'index']);

// Get a single image by id
Route::get('/images/{id}', [ImageApiController::class, 'show']);

// Create a new image
Route::post('/images', [ImageApiController::class, 'store']);

// Update an existing image
Route::put('/images/{id}', [ImageApiController::class, 'update']);

// Delete an image
Route::delete('/images/{id}', [ImageApiController::class, 'destroy']);
