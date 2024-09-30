<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Form to edit a delivery agency">
    <title>Edit Delivery Agency - Vali Admin</title>
    @vite(['resources/assets/css/main.css'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            max-width: 800px;
        }
        h1 {
            color: #343a40;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #5a6268;
        }
    </style>
</head>
<body class="app sidebar-mini">
    <header class="app-header"><a class="app-header__logo" href="{{ route('indexBack') }}">Vali</a>
    @include('BackOffice.partials.navbar')
    </header>
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    @include('BackOffice.partials.sidebar')
    
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="bi bi-pencil-square"></i> Edit Delivery Agency</h1>
            </div>
        </div>
        <div class="container">
            <form action="{{ route('delivery-agences.update', $agence->id) }}" method="POST" enctype="multipart/form-data" id="agencyForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $agence->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $agence->address) }}" required>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control @error('phoneNumber') is-invalid @enderror" id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber', $agence->phoneNumber) }}" required>
                        @error('phoneNumber')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small>Current Image: 
                            @if($agence->image)
                                <img src="{{ asset('storage/' . $agence->image) }}" alt="{{ $agence->name }}" style="width: 50px; height: auto;">
                            @else
                                <span>No Image</span>
                            @endif
                        </small>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="opening_hours" class="form-label">Opening Hours</label>
                        <input type="time" class="form-control @error('opening_hours') is-invalid @enderror" id="opening_hours" name="opening_hours" value="{{ old('opening_hours', $agence->opening_hours) }}" required>
                        @error('opening_hours')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="closing_hours" class="form-label">Closing Hours</label>
                        <input type="time" class="form-control @error('closing_hours') is-invalid @enderror" id="closing_hours" name="closing_hours" value="{{ old('closing_hours', $agence->closing_hours) }}" required>
                        @error('closing_hours')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('delivery-agences.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Update Agency</button>
                </div>
            </form>
        </div>
    </main>

    @vite(['resources/assets/js/jquery-3.7.0.min.js'])
    @vite(['resources/assets/js/bootstrap.min.js'])
</body>
</html>
