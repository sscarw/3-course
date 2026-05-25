@extends('layouts.admin.app')

@section('title', 'Edit Service')

@section('content')
<div class="container py-4">

    <!-- Page header -->
    <div class="dash-page-header">
        <div>
            <a href="{{ route('admin.dashboard') }}" class="dash-back-link">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
            <h1 class="dash-page-title mt-2">Edit Service</h1>
            <p class="dash-page-sub">Update service name and price</p>
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

    <div class="row">
        <div class="col-lg-5">
            <div class="card dash-form-card">
                <div class="card-body p-4">
                    <p class="dash-form-label-group">Service details</p>

                    <form action="{{ route('service.update', $service->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Service Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{ $service->name }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="price" class="form-label">Price (₴)</label>
                            <input type="number" class="form-control" id="price" name="price"
                                   value="{{ $service->price }}" required>
                        </div>

                        <button type="submit" class="btn btn-admin-primary w-100">
                            <i class="bi bi-check-lg me-1"></i> Save Changes
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
