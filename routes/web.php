<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

// Redirect the root URL "/" to the images listing page.
Route::get('/', function () {
    return redirect()->route('images.index'); // 'images.index' is the named route for listing images.
});

// Display list of images
Route::get('/images', [ImageController::class, 'index'])->name('images.index');

// Show form to upload a new image
Route::get('/images/create', [ImageController::class, 'create'])->name('images.create');

// Handle image upload and store in database
Route::post('/images', [ImageController::class, 'store'])->name('images.store');

// Show form to edit an existing image
Route::get('/images/{id}/edit', [ImageController::class, 'edit'])->name('images.edit');

// Update the image after editing
Route::put('/images/{id}', [ImageController::class, 'update'])->name('images.update');

// Delete an image record
Route::delete('/images/{id}', [ImageController::class, 'destroy'])->name('images.destroy');
