@extends('layouts.admin.app')

@section('title', 'Edit Barber')

@section('content')
<div class="container py-4">

    <!-- Page header -->
    <div class="dash-page-header">
        <div>
            <a href="{{ route('admin.dashboard') }}" class="dash-back-link">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
            <h1 class="dash-page-title mt-2">Edit Barber</h1>
            <p class="dash-page-sub">Update barber details and photo</p>
        </div>
    </div>

    <!-- Validation errors -->
    @if ($errors->any())
        <div class="alert dash-alert dash-alert-danger alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center gap-2 mb-1">
                <i class="bi bi-exclamation-circle-fill"></i>
                <strong>Please fix the following errors:</strong>
            </div>
            <ul class="mb-0 ps-4 mt-1" style="font-size:0.8125rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4 align-items-start">

        <!-- Form card -->
        <div class="col-lg-6">
            <div class="card dash-form-card">
                <div class="card-body p-4">
                    <p class="dash-form-label-group">Barber details</p>

                    <form action="{{ route('barber.update', $barber->id) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{ $barber->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                   value="{{ $barber->last_name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                   value="{{ $barber->phone }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="photo" class="form-label">Update Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                            <p class="edit-hint mt-1">Leave empty to keep the current photo.</p>
                        </div>

                        <button type="submit" class="btn btn-admin-primary w-100">
                            <i class="bi bi-check-lg me-1"></i> Save Changes
                        </button>

                    </form>
                </div>
            </div>
        </div>

        <!-- Current photo preview -->
        @if($barber->photo)
            <div class="col-lg-4">
                <div class="card dash-form-card">
                    <div class="card-body p-4">
                        <p class="dash-form-label-group">Current photo</p>
                        <div class="edit-photo-wrap">
                            <img src="{{ asset('/storage/barber_photos/' . $barber->photo) }}"
                                 alt="Current Photo"
                                 class="edit-photo-preview">
                        </div>
                        <p class="edit-hint mt-3">
                            <i class="bi bi-info-circle me-1"></i>
                            Upload a new photo to replace this one.
                        </p>
                    </div>
                </div>
            </div>
        @endif

    </div>

</div>
@endsection
