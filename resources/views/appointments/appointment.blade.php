@extends('site')

@section('title', 'Book an Appointment')

@section('content')
<div class="container my-5">

    <!-- Page heading -->
    <div class="text-center mb-5">
        <h1 class="appt-page-title">Book an Appointment</h1>
        <p class="appt-page-sub">Choose a barber, service, date and time slot</p>
    </div>

    <!-- Success message -->
    @if (session('success'))
        <div class="alert appt-alert-success d-flex align-items-center gap-2 mb-4" role="alert">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <form action="{{ route('appointments.store') }}" method="POST"
          class="appointment-form mx-auto">
        @csrf

        <!-- ── Step 1: Barber ── -->
        <div class="appt-step mb-4">
            <p class="appt-step-label">
                <span class="appt-step-num">1</span>
                Select a barber
            </p>
            <div class="row row-cols-1 row-cols-md-3 g-3">
                @foreach($barbers as $barber)
                    <div class="col">
                        <div class="card barber-card" data-id="{{ $barber->id }}">
                            <img src="{{ asset('/storage/barber_photos/' . $barber->photo) }}"
                                 class="card-img-top appt-barber-photo"
                                 alt="Barber Photo">
                            <div class="card-body text-center py-3 px-3">
                                <h6 class="appt-card-name mb-1">
                                    {{ $barber->name }} {{ $barber->last_name }}
                                </h6>
                                <p class="appt-card-sub mb-0">{{ $barber->phone }}</p>
                                <input type="radio" id="barber_{{ $barber->id }}" name="barber_id"
                                       value="{{ $barber->id }}" hidden>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- ── Step 2: Service ── -->
        <div class="appt-step mb-4">
            <p class="appt-step-label">
                <span class="appt-step-num">2</span>
                Select a service
            </p>
            <div class="row row-cols-1 row-cols-md-3 g-3">
                @foreach($services as $service)
                    <div class="col">
                        <div class="card service-card" data-id="{{ $service->id }}">
                            <div class="card-body text-center py-4 px-3">
                                <h6 class="appt-card-name mb-1">{{ $service->name }}</h6>
                                <p class="appt-service-price mb-0">{{ $service->price }} ₴</p>
                                <input type="radio" id="service_{{ $service->id }}" name="service_id"
                                       value="{{ $service->id }}" hidden>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- ── Step 3: Date ── -->
        <div class="appt-step mb-4">
            <p class="appt-step-label">
                <span class="appt-step-num">3</span>
                Choose a date
            </p>
            <input type="date" name="appointment_date" id="appointment_date"
                   class="form-control appt-date-input"
                   required
                   value="{{ \Carbon\Carbon::today()->toDateString() }}"
                   min="{{ \Carbon\Carbon::today()->toDateString() }}">
        </div>

        <!-- ── Step 4: Time ── -->
        <div class="appt-step mb-5">
            <p class="appt-step-label">
                <span class="appt-step-num">4</span>
                Choose a time
            </p>
            <div id="appointment-time-loader" class="spinner-border appt-spinner" role="status"
                 style="display: none">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="d-flex flex-wrap gap-2" id="appointment-time-list" style="display: flex">
                @foreach($time_slots as $time)
                    <button type="button"
                            class="btn time-slot disabled"
                            data-time="{{ $time }}" disabled>
                        {{ $time }}
                    </button>
                @endforeach
            </div>
            <input type="hidden" name="appointment_time" id="appointment_time">
        </div>

        <button type="submit" class="btn appt-submit-btn w-100">
            <i class="bi bi-calendar-check me-2"></i>Book Appointment
        </button>

    </form>
</div>

<script>
    const dateInput = document.getElementById('appointment_date');
    var selectedBarberId = null;
    var selectedDate = dateInput.value;

    dateInput.addEventListener('change', function () {
        selectedDate = this.value;
        updateTimeSlots();
    });

    document.querySelectorAll('.barber-card').forEach(card => {
        card.addEventListener('click', function () {
            const barberId = this.getAttribute('data-id');
            const barberInput = document.getElementById(`barber_${barberId}`);

            if (this.classList.contains('selected')) {
                this.classList.remove('selected');
                if (barberInput) barberInput.checked = false;
                selectedBarberId = null;
            } else {
                document.querySelectorAll('.barber-card').forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
                if (barberInput) barberInput.checked = true;
                selectedBarberId = barberId;
            }

            updateTimeSlots();
        });
    });

    document.querySelectorAll('.service-card').forEach(card => {
        card.addEventListener('click', function () {
            const serviceId = this.getAttribute('data-id');
            const serviceInput = document.getElementById(`service_${serviceId}`);

            if (this.classList.contains('selected')) {
                this.classList.remove('selected');
                if (serviceInput) {
                    serviceInput.checked = false;
                }
            } else {
                document.querySelectorAll('.service-card').forEach(c => c.classList.remove('selected'));
                document.querySelectorAll('.service-card input[type="radio"]').forEach(input => input.checked = false);

                this.classList.add('selected');
                if (serviceInput) {
                    serviceInput.checked = true;
                }
            }
        });
    });

    async function updateTimeSlots() {
        const loader = document.getElementById('appointment-time-loader');
        const timeList = document.getElementById('appointment-time-list');
        const timeSlots = document.querySelectorAll('.time-slot');
        const appointmentTimeInput = document.getElementById('appointment_time');

        appointmentTimeInput.value = '';
        timeSlots.forEach(slot => slot.classList.remove('selected'));

        if (!selectedBarberId || !selectedDate) {
            timeSlots.forEach(slot => {
                slot.classList.remove('disabled');
                slot.disabled = false;
            });
            return;
        }

        loader.style.display = 'block';
        timeList.style.display = 'none';

        try {
            const response = await fetch(`/check-time-availability/${selectedBarberId}/?date=${selectedDate}`);
            const data = await response.json();

            if (data) {
                timeSlots.forEach(slot => {
                    const time = slot.dataset.time;

                    if (data.includes(time)) {
                        slot.classList.add('disabled');
                        slot.disabled = true;
                    } else {
                        slot.classList.remove('disabled');
                        slot.disabled = false;
                    }
                });
            }
        } catch (error) {
            console.error('Error checking time availability:', error);
        } finally {
            loader.style.display = 'none';
            timeList.style.display = 'flex';
        }
    }

    document.querySelectorAll('.time-slot').forEach(slot => {
        slot.addEventListener('click', function () {
            if (this.classList.contains('disabled')) return;

            document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
            this.classList.add('selected');
            document.getElementById('appointment_time').value = this.dataset.time;
        });
    });
</script>
@endsection
