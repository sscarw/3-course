
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
    <title>Admin Login &mdash; BarberBook</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #0f172a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            margin: 0;
        }

        .login-wrap {
            width: 100%;
            max-width: 388px;
        }

        /* ── Brand ── */
        .login-brand {
            text-align: center;
            margin-bottom: 1.875rem;
        }

        .brand-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            background-color: rgba(245, 158, 11, 0.12);
            border-radius: 12px;
            margin-bottom: 1rem;
        }

        .brand-icon i {
            font-size: 1.375rem;
            color: #f59e0b;
        }

        .login-brand h1 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #f8fafc;
            letter-spacing: -0.02em;
            margin: 0 0 0.3rem;
        }

        .login-brand p {
            font-size: 0.8125rem;
            color: rgba(255, 255, 255, 0.38);
            margin: 0;
        }

        /* ── Card ── */
        .login-card {
            background-color: #1e293b;
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 14px;
            padding: 2rem 1.875rem 1.875rem;
            box-shadow: 0 24px 64px rgba(0, 0, 0, 0.55);
        }

        /* ── Form elements ── */
        .form-label {
            font-size: 0.8125rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.55);
            margin-bottom: 0.4rem;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: #f1f5f9;
            font-size: 0.875rem;
            font-family: 'Inter', sans-serif;
            padding: 0.625rem 0.875rem;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.18);
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.07);
            border-color: rgba(245, 158, 11, 0.55);
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
            color: #f1f5f9;
            outline: none;
        }

        /* Fix browser autofill background on dark inputs */
        .form-control:-webkit-autofill,
        .form-control:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 100px #1e293b inset;
            -webkit-text-fill-color: #f1f5f9;
            caret-color: #f1f5f9;
        }

        /* ── Submit button ── */
        .btn-login {
            width: 100%;
            background-color: #f59e0b;
            border: none;
            border-radius: 8px;
            color: #111827;
            font-family: 'Inter', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            padding: 0.675rem 1rem;
            transition: background-color 0.15s, transform 0.1s;
            cursor: pointer;
            letter-spacing: 0.01em;
        }

        .btn-login:hover {
            background-color: #d97706;
        }

        .btn-login:active {
            transform: scale(0.99);
        }

        /* ── Error alert ── */
        .error-alert {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.22);
            border-radius: 8px;
            color: #fca5a5;
            font-size: 0.8125rem;
            line-height: 1.5;
            padding: 0.75rem 1rem;
            margin-top: 1.25rem;
        }

        .error-alert i {
            flex-shrink: 0;
            font-size: 0.9rem;
            margin-top: 1px;
        }
    </style>
</head>
<body>

    <div class="login-wrap">

        <div class="login-brand">
            <div class="brand-icon">
                <i class="bi bi-scissors"></i>
            </div>
            <h1>BarberBook</h1>
            <p>Admin panel &mdash; sign in to continue</p>
        </div>

        <div class="login-card">
            <form action="{{ route('admin.login') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email"
                           placeholder="admin@example.com" required autocomplete="email">
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                           placeholder="••••••••" required autocomplete="current-password">
                </div>

                <button type="submit" class="btn-login">Sign in</button>
            </form>

            @if ($errors->any())
                <div class="error-alert">
                    <i class="bi bi-exclamation-circle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</body>
</html>
