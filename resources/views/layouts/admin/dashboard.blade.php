@extends('layouts.admin.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container py-4">

    <!-- Page header -->
    <div class="dash-page-header">
        <div>
            <h1 class="dash-page-title">Dashboard</h1>
            <p class="dash-page-sub">Manage barbers and services</p>
        </div>
    </div>

    <!-- ── Alerts ───────────────────────────────────────── -->
    @if(session('success'))
        <div class="alert dash-alert dash-alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert dash-alert dash-alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span>{{ session('error') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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

    <!-- ══════════════════════════════════════════════════ -->
    <!-- BARBERS SECTION                                    -->
    <!-- ══════════════════════════════════════════════════ -->
    <div class="dash-section-header">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-person-badge dash-section-icon"></i>
            <h2 class="dash-section-title">Barbers</h2>
            <span class="dash-count-badge">{{ $barbers->count() }}</span>
        </div>
    </div>

    <div class="row g-4 mb-5">

        <!-- Add Barber form -->
        <div class="col-lg-4">
            <div class="card dash-form-card h-100">
                <div class="card-body p-4">
                    <p class="dash-form-label-group">Add new barber</p>
                    <form action="{{ route('barber.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-4">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-plus-lg me-1"></i>Add Barber
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Barber cards list -->
        <div class="col-lg-8">
            @if($barbers->isEmpty())
                <div class="dash-empty-state">
                    <i class="bi bi-person-badge"></i>
                    <p>No barbers yet. Add one to get started.</p>
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-2 g-3">
                    @foreach($barbers as $barber)
                        <div class="col">
                            <div class="card dash-item-card h-100">
                                <img src="{{ asset('/storage/barber_photos/' . $barber->photo) }}"
                                     class="card-img-top dash-card-photo"
                                     alt="Barber Photo">
                                <div class="card-body px-3 pt-3 pb-3">
                                    <h6 class="dash-card-name mb-0">
                                        {{ $barber->name }} {{ $barber->last_name }}
                                    </h6>
                                    <p class="dash-card-meta">
                                        <i class="bi bi-telephone me-1"></i>{{ $barber->phone }}
                                    </p>
                                    <div class="d-flex gap-2 mt-3">
                                        <a href="{{ route('barber.edit', $barber->id) }}"
                                           class="btn btn-sm dash-btn-edit flex-fill">
                                            <i class="bi bi-pencil me-1"></i>Edit
                                        </a>
                                        <form action="{{ route('barber.delete', $barber->id) }}"
                                              method="POST" class="flex-fill">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm dash-btn-delete w-100">
                                                <i class="bi bi-trash me-1"></i>Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

    <!-- ══════════════════════════════════════════════════ -->
    <!-- SERVICES SECTION                                   -->
    <!-- ══════════════════════════════════════════════════ -->
    <div class="dash-section-header">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-scissors dash-section-icon"></i>
            <h2 class="dash-section-title">Services</h2>
            <span class="dash-count-badge">{{ $services->count() }}</span>
        </div>
    </div>

    <div class="row g-4 mb-5">

        <!-- Add Service form -->
        <div class="col-lg-4">
            <div class="card dash-form-card h-100">
                <div class="card-body p-4">
                    <p class="dash-form-label-group">Add new service</p>
                    <form action="{{ route('service.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="service_name" class="form-label">Service Name</label>
                            <input type="text" class="form-control" id="service_name" name="name" required>
                        </div>
                        <div class="mb-4">
                            <label for="price" class="form-label">Price (₴)</label>
                            <input type="number" id="price" name="price" class="form-control" step="0.01" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-plus-lg me-1"></i>Add Service
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Service cards list -->
        <div class="col-lg-8">
            @if($services->isEmpty())
                <div class="dash-empty-state">
                    <i class="bi bi-scissors"></i>
                    <p>No services yet. Add one to get started.</p>
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-2 g-3">
                    @foreach($services as $service)
                        <div class="col">
                            <div class="card dash-item-card h-100">
                                <div class="card-body d-flex flex-column p-4">
                                    <div class="flex-grow-1 mb-3">
                                        <h6 class="dash-card-name mb-1">{{ $service->name }}</h6>
                                        <span class="dash-service-price">{{ $service->price }} ₴</span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('service.edit', $service->id) }}"
                                           class="btn btn-sm dash-btn-edit flex-fill">
                                            <i class="bi bi-pencil me-1"></i>Edit
                                        </a>
                                        <form action="{{ route('service.delete', $service->id) }}"
                                              method="POST" class="flex-fill">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm dash-btn-delete w-100">
                                                <i class="bi bi-trash me-1"></i>Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

</div>
@endsection
