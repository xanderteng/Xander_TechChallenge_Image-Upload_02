<!DOCTYPE html>
<html>
<head>
    <title>Edit Image</title>
</head>
<body>
    <h1>Edit Image</h1>
    <!-- Form to update an existing image -->
    <form action="{{ route('images.update', $image->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Display the current image -->
        <p>Current Image:</p>
        <img src="{{ asset('storage/'.$image->image_path) }}" alt="Image" width="100">
        <br><br>
        <!-- Input to upload a new image (optional) -->
        <label for="image">Select New Image (optional):</label>
        <input type="file" name="image" id="image">
        <br><br>
        <!-- Submit button to update -->
        <button type="submit">Update</button>
    </form>
</body>
</html>
