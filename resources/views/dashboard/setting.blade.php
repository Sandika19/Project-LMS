@extends('components.layouts.layoutsDashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg p-6 max-w-md mx-auto">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Update Background Image</h2>

        @if(session('success'))
        <div class="bg-green-500 text-white px-4 py-2 rounded-md mb-6 text-center">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('admin.update.jumbotron') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-6">
                <label for="background_image" class="block text-sm font-medium text-gray-700">Upload New Background Image</label>
                <input type="file" id="background_image" name="background_image" 
                    class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 hover:border-indigo-400 transition duration-300"
                    onchange="previewImage(event)">
                <p class="text-xs text-gray-500 mt-1">Supported formats: JPG, PNG, JPEG</p>
            </div>

            <!-- Image Preview -->
            <div id="imagePreviewContainer" class="mb-6" style="display:none;">
                <p class="text-sm font-medium text-gray-700">Preview</p>
                <img id="imagePreview" src="" alt="Image Preview" class="mt-2 w-full h-40 object-cover rounded-lg shadow-md">
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300">
                Update Background
            </button>
        </form>
    </div>
</div>

<script>
    // Function to preview the selected image
    function previewImage(event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('imagePreviewContainer');
        const previewImage = document.getElementById('imagePreview');
        
        // If a file is selected, show the preview
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block'; // Show the preview container
            };
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none'; // Hide the preview if no file is selected
        }
    }
</script>
@endsection
