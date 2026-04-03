<div class="auth-wrapper">
    <a href="{{ url('/') }}" class="btn-volver">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Volver al inicio
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
    body { 
        font-family: 'Inter', sans-serif; 
        background-color: #f3f4f6; 
        margin: 0; 
        display: flex; 
        justify-content: center; 
        align-items: center; 
        height: 100vh; 
    }
    
    .auth-wrapper { 
        position: relative; 
        width: 100%; 
        max-width: 450px;
        margin: 0 auto;
    }
    .btn-volver { 
        position: absolute; 
        top: -70px;  
        left: 0; 
        text-decoration: none; 
        color: #6b7280; 
        display: inline-flex;
        align-items: center; 
        gap: 8px;
        font-size: 0.9rem;
        font-weight: 500;
        padding: 8px 12px;
        background-color: white;
        border-radius: 8px;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        z-index: 10;
    }
    
    .btn-volver:hover {
        color: #3b82f6;
        background-color: #f9fafb;
        transform: translateX(-2px);
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    }
    
    .btn-volver:active {
        transform: translateX(0);
    }
    
    .btn-volver svg {
        transition: transform 0.2s ease;
    }
    
    .btn-volver:hover svg {
        transform: translateX(-3px);
    }
    
    .btn-volver-inline:hover {
        color: #3b82f6;
        background-color: #f3f4f6;
    }
    
    .login-card { 
        background: white; 
        padding: 40px; 
        border-radius: 12px; 
        border: 1px solid #e5e7eb; 
        box-shadow: 0 4px 6px rgba(0,0,0,0.05); 
        width: 100%; 
        text-align: center; 
        position: relative;
    }
    

    .user-icon { 
        background-color: #eff6ff; 
        width: 70px; 
        height: 70px; 
        border-radius: 50%; 
        display: flex; 
        justify-content: center; 
        align-items: center; 
        margin: 0 auto 20px; 
    }
    
    .user-icon svg { 
        color: #3b82f6; 
        width: 35px; 
        height: 35px; 
    }
    
    .form-group { 
        text-align: left; 
        margin-bottom: 18px; 
    }
    
    label { 
        display: block; 
        font-size: 0.85rem; 
        font-weight: 500; 
        margin-bottom: 6px; 
        color: #374151; 
    }
    
    input { 
        width: 100%; 
        padding: 11px; 
        border: 1px solid #d1d5db; 
        border-radius: 6px; 
        box-sizing: border-box; 
        font-size: 0.95rem; 
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    
    input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
    }
    
    .btn-submit { 
        width: 100%; 
        background-color: #1f2937; 
        color: white; 
        padding: 12px; 
        border: none; 
        border-radius: 6px; 
        font-weight: 600; 
        cursor: pointer; 
        margin-top: 10px; 
        font-size: 1rem; 
        transition: background-color 0.2s ease;
    }
    
    .btn-submit:hover {
        background-color: #111827;
    }
    
    .error-alert { 
        background-color: #fee2e2; 
        color: #b91c1c; 
        padding: 10px; 
        border-radius: 6px; 
        margin-bottom: 15px; 
        font-size: 0.8rem; 
        text-align: left; 
        border-left: 4px solid #ef4444; 
    }
    
    h2 { 
        font-size: 1.4rem; 
        color: #111827; 
        margin: 0 0 5px; 
    }
    
    p { 
        color: #6b7280; 
        font-size: 0.9rem; 
        margin-bottom: 25px; 
    }
</style>
