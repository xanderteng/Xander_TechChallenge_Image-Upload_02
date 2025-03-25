<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    // Display a list of all images
    public function index()
    {
        // Retrieve all image records from the database
        $images = Image::all();
        // Return the 'index' view with the images data
        return view('images.index', compact('images'));
    }

    // Show the form to create a new image
    public function create()
    {
        // Return the 'create' view to upload a new image
        return view('images.create');
    }

    // Save a new image to storage and database
    public function store(Request $request)
    {
        // Validate that an image file is provided and its size is no more than 2MB
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        // If an image is uploaded, store it in the 'public/images' directory
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
        }

        // Create a new database record for the image
        Image::create([
            'image_path' => $path,
        ]);

        // Redirect back to the image list with a success message
        return redirect()->route('images.index')->with('success', 'Image uploaded successfully.');
    }

    // Show the form to edit an existing image
    public function edit($id)
    {
        // Find the image by its id; abort if not found
        $image = Image::findOrFail($id);
        // Return the 'edit' view with the current image data
        return view('images.edit', compact('image'));
    }

    // Update the image in storage and in the database
    public function update(Request $request, $id)
    {
        // Validate that if an image is provided, it must be a valid image file with a maximum size of 2MB
        $request->validate([
            'image' => 'sometimes|image|max:2048',
        ]);

        // Retrieve the existing image record
        $image = Image::findOrFail($id);

        // If a new image file is uploaded, delete the old file and store the new one
        if ($request->hasFile('image')) {
            // Check if the old image file exists and delete it
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
            // Store the new image file and update the image path in the record
            $path = $request->file('image')->store('images', 'public');
            $image->image_path = $path;
        }

        // Save the updated image record in the database
        $image->save();

        // Redirect back with a success message
        return redirect()->route('images.index')->with('success', 'Image updated successfully.');
    }

    // Delete an image from storage and database
    public function destroy($id)
    {
        // Retrieve the image record
        $image = Image::findOrFail($id);

        // Delete the image file from storage if it exists
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        // Remove the record from the database
        $image->delete();

        // Redirect back with a success message
        return redirect()->route('images.index')->with('success', 'Image deleted successfully.');
    }
}
