<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/appointment.css')
    <title>@yield('title')</title>
</head>
<body>

    <header>
        <nav class="navbar navbar-dark py-3" style="background-color: #111827;">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2 fw-semibold fs-5" href="{{ route('appointments.index') }}">
                    <i class="bi bi-scissors" style="color: #f59e0b;"></i>
                    BarberBook
                </a>
            </div>
        </nav>
    </header>

    @vite('resources/js/app.js')

    <main>
        @yield('content')
    </main>

    <footer class="py-4 mt-auto border-top" style="background-color: #f9fafb;">
        <div class="container text-center">
            <small class="text-muted">&copy; {{ date('Y') }} BarberBook &mdash; Online appointment booking</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</body>
</html>
