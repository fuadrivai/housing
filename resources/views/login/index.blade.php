<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MHIS House System | Login</title>

    <link href="/assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="/assets/plugins/lucide.min.js"></script>
    <link rel="stylesheet" href="/assets/app/app.css">
    <style>
        :root {
            --body-bg: #f1f5f9;
            --card-bg: #ffffff;
            --card-shadow: 0 20px 50px rgba(0, 0, 0, 0.06), 0 6px 20px rgba(0, 0, 0, 0.04);
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --border-color: #e2e8f0;
            --accent-blue: #6366f1;
            --accent-purple: #8b5cf6;
            --radius: 14px;
            --radius-sm: 10px;
            --radius-lg: 18px;
            --transition: 180ms ease;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #f0f4ff 0%, #eef2ff 50%, #f8fafc 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            margin: 0;
            color: var(--text-primary);
            -webkit-font-smoothing: antialiased;
        }

        /* Decorative background shapes */
        body::before {
            content: '';
            position: fixed;
            top: -150px;
            right: -100px;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -120px;
            left: -80px;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.06) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .login-container {
            width: 100%;
            max-width: 460px;
            position: relative;
            z-index: 1;
        }

        .login-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            box-shadow: var(--card-shadow);
            padding: 40px 36px;
            border: 1px solid rgba(226, 232, 240, 0.6);
            transition: all var(--transition);
        }

        /* Logo */
        .brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 32px;
        }

        .brand-icon {
            width: 44px;
            height: 44px;
            border-radius: var(--radius-sm);
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 20px;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .brand-name {
            font-weight: 700;
            font-size: 1.6rem;
            letter-spacing: -0.02em;
            color: var(--text-primary);
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 28px;
        }

        .welcome-text h2 {
            font-weight: 700;
            font-size: 1.4rem;
            letter-spacing: -0.02em;
            margin-bottom: 6px;
            color: var(--text-primary);
        }

        .welcome-text p {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin: 0;
        }

        /* Form styles */
        .form-label {
            font-weight: 600;
            font-size: 0.82rem;
            letter-spacing: 0.02em;
            color: var(--text-primary);
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 18px;
        }

        .input-group-custom .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color var(--transition);
        }

        .form-control-custom {
            width: 100%;
            padding: 12px 14px 12px 44px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            color: var(--text-primary);
            background: #fafbfc;
            transition: all var(--transition);
            outline: none;
            box-shadow: none;
        }

        .form-control-custom:focus {
            border-color: var(--accent-blue);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .form-control-custom:focus~.input-icon,
        .input-group-custom:focus-within .input-icon {
            color: var(--accent-blue);
        }

        /* Password toggle */
        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 4px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            transition: color var(--transition);
            outline: none;
        }

        .password-toggle:hover {
            color: var(--text-primary);
        }

        .password-toggle:focus-visible {
            outline: 2px solid var(--accent-blue);
            outline-offset: 2px;
        }

        /* Options row */
        .options-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
            font-size: 0.85rem;
        }

        .custom-checkbox {
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            user-select: none;
        }

        .custom-checkbox input[type="checkbox"] {
            accent-color: var(--accent-blue);
            width: 16px;
            height: 16px;
            margin: 0;
            cursor: pointer;
        }

        .forgot-link {
            color: var(--accent-blue);
            text-decoration: none;
            font-weight: 600;
            transition: color var(--transition);
        }

        .forgot-link:hover {
            color: #4f46e5;
            text-decoration: underline;
        }

        /* Button */
        .btn-login {
            width: 100%;
            padding: 12px 20px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: #fff;
            border: none;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.01em;
            cursor: pointer;
            transition: all var(--transition);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: inherit;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            box-shadow: 0 6px 18px rgba(99, 102, 241, 0.4);
            transform: translateY(-1px);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login:focus-visible {
            outline: 2px solid var(--accent-blue);
            outline-offset: 3px;
        }

        .btn-login:disabled {
            opacity: 0.7;
            pointer-events: none;
        }

        /* Alert */
        .alert-custom {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            border-radius: var(--radius-sm);
            padding: 12px 16px;
            font-size: 0.85rem;
            margin-bottom: 18px;
            display: none;
        }

        .alert-custom.show {
            display: block;
        }

        /* Demo hint */
        .demo-hint {
            text-align: center;
            margin-top: 24px;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .demo-hint strong {
            color: var(--accent-purple);
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 28px 22px;
            }

            .brand-icon {
                width: 38px;
                height: 38px;
            }

            .brand-name {
                font-size: 1.4rem;
            }

            .welcome-text h2 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-card">
            <!-- Brand -->
            <div class="brand">
                <div class="brand-icon">
                    <i data-lucide="graduation-cap" style="width:22px;height:22px;"></i>
                </div>
                <span class="brand-name">EduAdmin</span>
            </div>

            <!-- Welcome -->
            <div class="welcome-text">
                <h2>Welcome back</h2>
                <p>Sign in to your school management dashboard</p>
            </div>

            <!-- Error Alert -->
            <div class="alert-custom" id="loginAlert">
                <i data-lucide="alert-circle"
                    style="width:16px;height:16px; vertical-align: middle; margin-right: 4px;"></i>
                <span id="alertMessage">Invalid credentials. Please try again.</span>
            </div>

            <!-- Login Form -->
            <form method="POST" action="/auth" id="loginForm" novalidate>
                @csrf
                <!-- Email -->
                <div class="mb-2">
                    <label class="form-label" for="email">
                        <i data-lucide="mail" style="width:14px;height:14px;"></i> Email address
                    </label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="at-sign" style="width:18px;height:18px;"></i></span>
                        <input name="email" type="email" class="form-control-custom" id="email"
                            placeholder="example@email.com" required autocomplete="email" value="">
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-2">
                    <label class="form-label" for="password">
                        <i data-lucide="lock" style="width:14px;height:14px;"></i> Password
                    </label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="key" style="width:18px;height:18px;"></i></span>
                        <input name="password" type="password" class="form-control-custom" id="password"
                            placeholder="••••••••" required autocomplete="current-password" value="">
                        <button type="button" class="password-toggle" id="togglePassword" tabindex="-1"
                            aria-label="Toggle password visibility">
                            <i data-lucide="eye-off" style="width:18px;height:18px;"></i>
                        </button>
                    </div>
                </div>

                <!-- Options -->
                <div class="options-row">
                    <label class="custom-checkbox">
                        <input type="checkbox" checked> Remember me
                    </label>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-login" id="loginButton">
                    <i data-lucide="log-in" style="width:18px;height:18px;"></i> Sign In
                </button>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(function() {
            // Initialize Lucide icons
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

            // Password visibility toggle
            $('#togglePassword').on('click', function(e) {
                e.preventDefault();
                const $input = $('#password');
                const type = $input.attr('type') === 'password' ? 'text' : 'password';
                $input.attr('type', type);

                // Toggle icon
                const $icon = $(this).find('i');
                const newIcon = type === 'password' ? 'eye-off' : 'eye';
                $icon.attr('data-lucide', newIcon);
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons({
                        attr: 'data-lucide'
                    });
                }
            });


            // Hide alert on input
            $('#email, #password').on('input', function() {
                $('#loginAlert').removeClass('show');
            });

            // Forgot password link
            $('.forgot-link').on('click', function(e) {
                e.preventDefault();
                alert(
                    'Password reset link would be sent to your email. (Demo feature not implemented)');
            });

            // Add shake keyframes dynamically
            const styleSheet = document.createElement("style");
            styleSheet.textContent = `
                @keyframes shake {
                  0%, 100% { transform: translateX(0); }
                  25% { transform: translateX(-6px); }
                  50% { transform: translateX(6px); }
                  75% { transform: translateX(-4px); }
                }
              `;
            document.head.appendChild(styleSheet);
        });
    </script>
</body>

</html>
