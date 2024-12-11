<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Record</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            /* Light grey background for better contrast */
        }

        .form-container {
            background: #ffffff;
            /* White background for the form */
            padding: 30px;
            /* Add padding */
            border-radius: 8px;
            /* Rounded corners */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Subtle shadow for depth */
        }

        .form-title {
            font-weight: 600;
            /* Bold title */
            color: #333333;
            /* Dark text */
        }

        .form-label {
            font-weight: 500;
            /* Slightly bold labels */
            color: #555555;
            /* Medium grey for labels */
        }

        .form-control,
        .form-select {
            border-radius: 6px;
            /* Rounded inputs */
        }

        .btn-primary {
            background-color: #007bff;
            /* Bootstrap primary blue */
            border: none;
            /* No border */
            border-radius: 6px;
            /* Rounded button */
        }

        .btn-primary:hover {
            background-color: #0056b3;
            /* Darker blue on hover */
        }

        #imagePreview {
            margin-top: 10px;
            /* Add spacing from file input */
            border: 1px solid #ddd;
            /* Add border to preview */
            padding: 5px;
            /* Add padding around image */
            border-radius: 6px;
            /* Rounded corners for image */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-10 col-md-8 col-lg-6 form-container">
                <h2 class="mb-4 text-center text-black font-weight-bold" style="font-size: 2.0rem;">
                    Add Records
                </h2>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('form.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Name Input -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Enter your name" required>
                    </div>
                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label for="profileImage" class="form-label">Upload Profile Image</label>
                        <input type="file" class="form-control mb-2" name="image" id="profileImage"
                            accept="image/*" onchange="previewImage(event)">
                        <img id="imagePreview" src="#" alt="Image Preview" width="100" style="display:none">
                    </div>
                    <!-- Radio Buttons -->
                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="male"
                                required>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="other" value="other">
                            <label class="form-check-label" for="other">Other</label>
                        </div>
                    </div>
                    <!-- Checkboxes -->
                    <div class="mb-3">
                        <label class="form-label">Skills</label>
                        <div class="form-check">
                            <input class="form-check-input" name="skill[]" type="checkbox" id="php"
                                value="PHP">
                            <label class="form-check-label" for="php">PHP</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="skill[]" type="checkbox" id="python"
                                value="Python">
                            <label class="form-check-label" for="python">Python</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="skill[]" type="checkbox" id="java"
                                value="Java">
                            <label class="form-check-label" for="java">Java</label>
                        </div>
                    </div>

                    <!-- Country Select -->
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <select class="form-select" id="country" name="country" required>
                            <option value="" disabled selected>Select your country</option>
                            <option value="india">India</option>
                            <option value="usa">United States</option>
                            <option value="uk">United Kingdom</option>
                            <option value="australia">Australia</option>
                            <option value="canada">Canada</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100">Submit</button>
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

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }
</script>
