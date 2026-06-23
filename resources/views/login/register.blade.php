<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>MHIS House System | Register</title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@0.344.0/dist/umd/lucide.min.js"></script>

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

        .register-container {
            width: 100%;
            max-width: 500px;
            position: relative;
            z-index: 1;
        }

        .register-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            box-shadow: var(--card-shadow);
            padding: 40px 36px;
            border: 1px solid rgba(226, 232, 240, 0.6);
            transition: all var(--transition);
        }

        /* Brand */
        .brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 24px;
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
            z-index: 2;
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
            z-index: 2;
        }

        .password-toggle:hover {
            color: var(--text-primary);
        }

        .password-toggle:focus-visible {
            outline: 2px solid var(--accent-blue);
            outline-offset: 2px;
        }

        /* Role dropdown */
        .form-select-custom {
            width: 100%;
            padding: 12px 14px 12px 44px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            color: var(--text-primary);
            background-color: #fafbfc;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 16px 12px;
            appearance: none;
            transition: all var(--transition);
            outline: none;
            box-shadow: none;
        }

        .form-select-custom:focus {
            border-color: var(--accent-blue);
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        /* Terms checkbox */
        .terms-check {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 0.85rem;
            color: var(--text-secondary);
            margin-bottom: 22px;
        }

        .terms-check input[type="checkbox"] {
            accent-color: var(--accent-blue);
            width: 16px;
            height: 16px;
            margin-top: 2px;
            flex-shrink: 0;
            cursor: pointer;
        }

        .terms-check a {
            color: var(--accent-blue);
            text-decoration: none;
            font-weight: 600;
        }

        .terms-check a:hover {
            text-decoration: underline;
        }

        /* Button */
        .btn-register {
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

        .btn-register:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            box-shadow: 0 6px 18px rgba(99, 102, 241, 0.4);
            transform: translateY(-1px);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .btn-register:focus-visible {
            outline: 2px solid var(--accent-blue);
            outline-offset: 3px;
        }

        .btn-register:disabled {
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

        .alert-custom.success {
            background: #f0fdf4;
            color: #166534;
            border-color: #bbf7d0;
        }

        /* Sign in link */
        .signin-link {
            text-align: center;
            margin-top: 24px;
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .signin-link a {
            color: var(--accent-blue);
            text-decoration: none;
            font-weight: 600;
        }

        .signin-link a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .register-card {
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

    <div class="register-container">
        <div class="register-card">
            <!-- Brand -->
            <div class="brand">
                <div class="brand-icon">
                    <i data-lucide="graduation-cap" style="width:22px;height:22px;"></i>
                </div>
                <span class="brand-name">EduAdmin</span>
            </div>

            <!-- Welcome -->
            <div class="welcome-text">
                <h2>Create your account</h2>
                <p>Join the school management platform</p>
            </div>

            <!-- Error / Success Alert -->
            <div class="alert-custom" id="registerAlert">
                <i data-lucide="alert-circle"
                    style="width:16px;height:16px; vertical-align: middle; margin-right: 4px;"></i>
                <span id="alertMessage"></span>
            </div>

            <!-- Registration Form -->
            <form id="registerForm" novalidate>
                <!-- Full Name -->
                <div class="mb-2">
                    <label class="form-label" for="fullName">
                        <i data-lucide="user" style="width:14px;height:14px;"></i> Full Name
                    </label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="user-circle"
                                style="width:18px;height:18px;"></i></span>
                        <input type="text" class="form-control-custom" id="fullName" placeholder="John Smith"
                            required>
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-2">
                    <label class="form-label" for="email">
                        <i data-lucide="mail" style="width:14px;height:14px;"></i> Email address
                    </label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="at-sign" style="width:18px;height:18px;"></i></span>
                        <input type="email" class="form-control-custom" id="email" placeholder="john@eduadmin.com"
                            required autocomplete="email">
                    </div>
                </div>

                <!-- Role -->
                <div class="mb-2">
                    <label class="form-label" for="role">
                        <i data-lucide="briefcase" style="width:14px;height:14px;"></i> Role
                    </label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="users" style="width:18px;height:18px;"></i></span>
                        <select class="form-select-custom" id="role" required>
                            <option value="" disabled selected>Select your role</option>
                            <option value="admin">Administrator</option>
                            <option value="teacher">Teacher</option>
                            <option value="student">Student</option>
                        </select>
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-2">
                    <label class="form-label" for="password">
                        <i data-lucide="lock" style="width:14px;height:14px;"></i> Password
                    </label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="key" style="width:18px;height:18px;"></i></span>
                        <input type="password" class="form-control-custom" id="password" placeholder="••••••••"
                            required autocomplete="new-password">
                        <button type="button" class="password-toggle" data-target="password" tabindex="-1"
                            aria-label="Toggle password visibility">
                            <i data-lucide="eye-off" style="width:18px;height:18px;"></i>
                        </button>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="mb-2">
                    <label class="form-label" for="confirmPassword">
                        <i data-lucide="lock" style="width:14px;height:14px;"></i> Confirm Password
                    </label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="key" style="width:18px;height:18px;"></i></span>
                        <input type="password" class="form-control-custom" id="confirmPassword"
                            placeholder="••••••••" required autocomplete="new-password">
                        <button type="button" class="password-toggle" data-target="confirmPassword" tabindex="-1"
                            aria-label="Toggle password visibility">
                            <i data-lucide="eye-off" style="width:18px;height:18px;"></i>
                        </button>
                    </div>
                </div>

                <!-- Terms Checkbox -->
                <label class="terms-check">
                    <input type="checkbox" id="termsCheckbox" required>
                    <span>I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy
                            Policy</a></span>
                </label>

                <!-- Submit -->
                <button type="submit" class="btn-register" id="registerButton">
                    <i data-lucide="user-plus" style="width:18px;height:18px;"></i> Create Account
                </button>
            </form>

            <!-- Sign in link -->
            <div class="signin-link">
                Already have an account? <a href="login.html">Sign in</a>
            </div>
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
            $('.password-toggle').on('click', function(e) {
                e.preventDefault();
                const targetId = $(this).data('target');
                const $input = $('#' + targetId);
                const type = $input.attr('type') === 'password' ? 'text' : 'password';
                $input.attr('type', type);

                const $icon = $(this).find('i');
                const newIcon = type === 'password' ? 'eye-off' : 'eye';
                $icon.attr('data-lucide', newIcon);
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons({
                        attr: 'data-lucide'
                    });
                }
            });

            // Form submission
            $('#registerForm').on('submit', function(e) {
                e.preventDefault();

                const fullName = $('#fullName').val().trim();
                const email = $('#email').val().trim();
                const role = $('#role').val();
                const password = $('#password').val();
                const confirmPassword = $('#confirmPassword').val();
                const termsAccepted = $('#termsCheckbox').is(':checked');

                const $alert = $('#registerAlert');
                const $alertMessage = $('#alertMessage');

                // Reset alert
                $alert.removeClass('show success');

                // Validation
                if (!fullName || !email || !role || !password || !confirmPassword) {
                    showAlert('Please fill in all fields.', false);
                    return;
                }

                if (!isValidEmail(email)) {
                    showAlert('Please enter a valid email address.', false);
                    return;
                }

                if (password.length < 6) {
                    showAlert('Password must be at least 6 characters long.', false);
                    return;
                }

                if (password !== confirmPassword) {
                    showAlert('Passwords do not match.', false);
                    return;
                }

                if (!termsAccepted) {
                    showAlert('You must agree to the Terms of Service and Privacy Policy.', false);
                    return;
                }

                // Simulate registration
                const $button = $('#registerButton');
                $button.prop('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creating account...'
                );

                // Mock async registration (demo)
                setTimeout(function() {
                    // Show success
                    $alert.addClass('show success');
                    $alertMessage.html(
                        '<i data-lucide="check-circle" style="width:16px;height:16px; vertical-align: middle; margin-right: 4px;"></i> Account created successfully! Redirecting...'
                    );
                    if (typeof lucide !== 'undefined') lucide.createIcons();

                    // Redirect to login page after 1.5s
                    setTimeout(function() {
                        window.location.href = 'login.html';
                    }, 1500);
                }, 1000);
            });

            function showAlert(message, isSuccess = false) {
                const $alert = $('#registerAlert');
                const $alertMessage = $('#alertMessage');
                $alert.removeClass('success');
                if (isSuccess) {
                    $alert.addClass('success');
                }
                $alertMessage.text(message);
                $alert.addClass('show');
                // Shake animation for error
                if (!isSuccess) {
                    $('.register-card').css('animation', 'shake 0.3s ease');
                    setTimeout(() => $('.register-card').css('animation', ''), 300);
                }
            }

            function isValidEmail(email) {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
            }

            // Clear alert on input change
            $('#registerForm input, #registerForm select').on('input change', function() {
                $('#registerAlert').removeClass('show success');
            });

            // Add shake keyframes
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
