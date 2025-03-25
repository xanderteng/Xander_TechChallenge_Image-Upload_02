<!DOCTYPE html>
<html>
<head>
    <title>Image List</title>
</head>
<body>
    <h1>Image List</h1>
    <!-- Link to the image upload form -->
    <a href="{{ route('images.create') }}">Upload New Image</a>
    
    <!-- Display success message if available -->
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <!-- Loop through each image and display it -->
    <ul>
        @foreach($images as $image)
            <li>
                <!-- Display the image using its stored path -->
                <img src="{{ asset('storage/'.$image->image_path) }}" alt="Image" width="100">
                <!-- Link to edit the image -->
                <a href="{{ route('images.edit', $image->id) }}">Edit</a>
                <!-- Form to delete the image -->
                <form action="{{ route('images.destroy', $image->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
