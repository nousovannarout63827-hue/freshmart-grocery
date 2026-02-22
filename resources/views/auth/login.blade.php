<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Grocery System</title>
    @vite(['resources/css/login-style.css', 'resources/js/app.js'])
</head>
<body>
    <div class="login-card">
        <div class="brand-logo">🛒</div>
        <h2>Welcome Back</h2>
        <p style="color: #6b7280; font-size: 14px; margin-bottom: 30px; font-weight: 500;">Sign in to access your dashboard</p>

        @if($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="error-message" style="background: #fef2f2; border: 2px solid #ef4444; color: #dc2626; padding: 14px 16px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-weight: 600; font-size: 14px;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 20px; height: 20px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                </svg>
                <span>{{ session('error') }}</span>
                <button type="button" onclick="this.parentElement.style.display='none';" style="margin-left: auto; background: none; border: none; cursor: pointer; font-size: 18px; color: #dc2626;">&times;</button>
            </div>
        @endif

        @if(session('info'))
            <div class="success-message" style="background: #eff6ff; border: 2px solid #3b82f6; color: #1d4ed8; padding: 14px 16px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-weight: 600; font-size: 14px;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 20px; height: 20px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>
                <span>{{ session('info') }}</span>
                <button type="button" onclick="this.parentElement.style.display='none';" style="margin-left: auto; background: none; border: none; cursor: pointer; font-size: 18px; color: #1d4ed8;">&times;</button>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required value="{{ old('email') }}" placeholder="admin@grocery.com">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-wrapper" style="position: relative;">
                    <input type="password" id="password" name="password" required placeholder="••••••••" 
                           style="width: 100%; padding-right: 45px;">
                    <button type="button" id="togglePassword" 
                            style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; font-size: 18px;">
                        👁️
                    </button>
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <label class="remember-me">
                    <input type="checkbox" name="remember">
                    Remember me
                </label>
                <span style="font-size: 12px; color: #9ca3af;">Contact SuperAdmin for password reset</span>
            </div>

            <button type="submit" class="btn-login">Sign In</button>
        </form>

        <div style="margin-top: 30px; padding-top: 24px; border-top: 1px solid #e5e7eb;">
            <p style="font-size: 11px; font-weight: 700; color: #9ca3af; text-transform: uppercase; margin-bottom: 12px;">Demo Credentials</p>
            <div style="text-align: left; font-size: 12px;">
                <div style="background: #eef2ff; padding: 10px; border-radius: 8px; margin-bottom: 8px;">
                    <strong style="color: #4f46e5;">👤 Admin:</strong> 
                    <span style="color: #6b7280;">admin@grocery.com</span> / 
                    <span style="color: #6b7280;">password123</span>
                </div>
                <div style="background: #fffbeb; padding: 10px; border-radius: 8px;">
                    <strong style="color: #d97706;">🚚 Driver:</strong> 
                    <span style="color: #6b7280;">driver@grocery.com</span> / 
                    <span style="color: #6b7280;">password123</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.textContent = type === 'password' ? '👁️' : '🙈';
        });
    </script>
</body>
</html>
