<!DOCTYPE html>
<html>
<head>
    <title>Upload New Image</title>
</head>
<body>
    <h1>Upload New Image</h1>
    <!-- Form for uploading a new image -->
    <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- File input for the image -->
        <label for="image">Select Image:</label>
        <input type="file" name="image" id="image" required>
        <br><br>
        <!-- Submit button to upload -->
        <button type="submit">Upload</button>
    </form>
</body>
</html>
