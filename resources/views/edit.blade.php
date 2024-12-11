<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            /* Light grey background */
        }

        .form-container {
            background: #ffffff;
            /* White form background */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
        }

        .form-title {
            font-weight: 600;
            color: #333333;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 500;
            color: #555555;
        }

        .form-control,
        .form-select {
            border-radius: 6px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 6px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .current-image {
            display: block;
            margin-top: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 5px;
            width: 100px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-10 col-md-8 col-lg-6 form-container">
                <h2 class="mb-4 text-center text-black font-weight-bold" style="font-size: 2.0rem;">
                    Update Records
                </h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('form.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name', $data->name) }}" required>
                    </div>

                    <!-- Gender -->
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select name="gender" id="gender" class="form-select" required>
                            <option value="male" {{ $data->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $data->gender == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ $data->gender == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <!-- Skills -->
                    <div class="mb-3">
                        <label class="form-label">Skills</label>
                        <div class="form-check">
                            <input class="form-check-input" name="skill[]" type="checkbox" id="php" value="PHP"
                                {{ in_array('PHP', explode(',', $data->skill)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="php">PHP</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="skill[]" type="checkbox" id="python" value="Python"
                                {{ in_array('Python', explode(',', $data->skill)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="python">Python</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="skill[]" type="checkbox" id="java" value="Java"
                                {{ in_array('Java', explode(',', $data->skill)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="java">Java</label>
                        </div>
                    </div>

                    <!-- Country -->
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <select class="form-select" id="country" name="country" required>
                            <option value="" disabled>Select your country</option>
                            <option value="india" {{ $data->country == 'india' ? 'selected' : '' }}>India</option>
                            <option value="usa" {{ $data->country == 'usa' ? 'selected' : '' }}>United States
                            </option>
                            <option value="uk" {{ $data->country == 'uk' ? 'selected' : '' }}>United Kingdom
                            </option>
                            <option value="australia" {{ $data->country == 'australia' ? 'selected' : '' }}>Australia
                            </option>
                            <option value="canada" {{ $data->country == 'canada' ? 'selected' : '' }}>Canada</option>
                        </select>
                    </div>
                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" id="image" class="form-control"
                            onchange="previewImage(event)">

                        <!-- Image Preview -->
                        <img id="imagePreview" src="#" alt="Image Preview" class="mt-2"
                            style="display:none; width: 100px; border: 1px solid #ddd; border-radius: 8px; padding: 5px;">

                        <!-- Current Image (hidden initially) -->
                        @if ($data->image)
                            <div id="currentImageWrapper" class="mt-2">
                                <label>Current Image:</label>
                                <img src="{{ asset('storage/images/' . $data->image) }}" alt="Current Image"
                                    class="current-image" width="100">
                            </div>
                        @endif
                    </div>
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100">Update</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');
        const currentImageWrapper = document.getElementById('currentImageWrapper');
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
            currentImageWrapper.style.display = 'none';
        } else {
            preview.src = '#';
            preview.style.display = 'none';
            currentImageWrapper.style.display = 'block';
        }
    }
</script>
