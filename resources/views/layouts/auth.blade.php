<div class="auth-wrapper">
    <a href="{{ url('/') }}" class="btn-volver">
        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Volver
    </a>

    <div class="login-card">
        <div class="user-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </div>
        
        @yield('content')
    </div>
</div>

<style>
    body { font-family: 'Inter', sans-serif; background-color: #f3f4f6; margin: 0; display: flex; justify-content: center; align-items: center; height: 100vh; }
    .auth-wrapper { position: relative; width: 100%; display: flex; justify-content: center; }
    .btn-volver { position: absolute; top: -60px; left: 0; text-decoration: none; color: #6b7280; display: flex; align-items: center; font-size: 0.9rem; }
    .login-card { background: white; padding: 40px; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 4px 6px rgba(0,0,0,0.05); width: 100%; max-width: 400px; text-align: center; }
    .user-icon { background-color: #eff6ff; width: 70px; height: 70px; border-radius: 50%; display: flex; justify-content: center; align-items: center; margin: 0 auto 20px; }
    .user-icon svg { color: #3b82f6; width: 35px; height: 35px; }
    .form-group { text-align: left; margin-bottom: 18px; }
    label { display: block; font-size: 0.85rem; font-weight: 500; margin-bottom: 6px; color: #374151; }
    input { width: 100%; padding: 11px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box; font-size: 0.95rem; }
    .btn-submit { width: 100%; background-color: #1f2937; color: white; padding: 12px; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; margin-top: 10px; font-size: 1rem; }
    .error-alert { background-color: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 6px; margin-bottom: 15px; font-size: 0.8rem; text-align: left; border-left: 4px solid #ef4444; }
    h2 { font-size: 1.4rem; color: #111827; margin: 0 0 5px; }
    p { color: #6b7280; font-size: 0.9rem; margin-bottom: 25px; }
</style>
