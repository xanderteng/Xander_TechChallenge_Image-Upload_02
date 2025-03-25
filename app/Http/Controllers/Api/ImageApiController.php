<?php

namespace App\Http\Controllers\Api;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImageApiController extends Controller
{
    // Return a JSON list of all images
    public function index()
    {
        $images = Image::all();
        return response()->json($images);
    }

    // Store a new image via API
    public function store(Request $request)
    {
        // Validate that an image file is provided
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        // Store the uploaded image file
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
        }

        // Create a new image record in the database
        $image = Image::create([
            'image_path' => $path,
        ]);

        // Return a JSON response with a success message and the new image data
        return response()->json(['message' => 'Image uploaded successfully.', 'image' => $image], 201);
    }

    // Return details of a specific image in JSON format
    public function show($id)
    {
        $image = Image::findOrFail($id);
        return response()->json($image);
    }

    // Update an existing image via API
    public function update(Request $request, $id)
    {
        // Validate that if an image file is provided, it is valid
        $request->validate([
            'image' => 'sometimes|image|max:2048',
        ]);

        // Retrieve the image record to update
        $image = Image::findOrFail($id);

        // If a new image file is uploaded, handle file replacement
        if ($request->hasFile('image')) {
            // Delete the existing image file if it exists
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
            // Store the new image file and update the image path
            $path = $request->file('image')->store('images', 'public');
            $image->image_path = $path;
        }

        // Save the updated record in the database
        $image->save();

        // Return a JSON response with a success message and updated image data
        return response()->json(['message' => 'Image updated successfully.', 'image' => $image]);
    }

    // Delete an image via API
    public function destroy($id)
    {
        $image = Image::findOrFail($id);

        // Delete the image file from storage if it exists
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        // Delete the image record from the database
        $image->delete();

        // Return a JSON response confirming deletion
        return response()->json(['message' => 'Image deleted successfully.']);
    }
}
