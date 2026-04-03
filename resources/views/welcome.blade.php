<div class="container">
    <div class="logo">
        <img src="{{ asset('/img/logo png.png') }}" alt="KYL Solutions">
       
    </div>

    <div class="cards-wrapper">
        <div class="card">
            <div class="icon">       
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </div>
            <h3>Administrador</h3>
            <a href="{{ route('login') }}" class="btn">Acceder como Admin</a>
        </div>

        <div class="card">
            <div class="icon">
        
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            </div>
            <h3>Vendedor</h3>
            <a href="{{ route('login') }}" class="btn">Acceder como Vendedor</a>
        </div>
        <div class="card">
            <div class="icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            </div>
            <h3>Gerente</h3>
            <a href="{{ route('login') }}" class="btn">Acceder como Gerente</a>
        </div>        
    </div>
</div>

<style>

   body {
    margin-top: 5%;
    font-family: 'Hero', sans-serif;
   }
    .logo {
        display: flex;             
        justify-content: center;    
        align-items: center;        
        margin-bottom: 24px;        
    }

    .logo img {
        max-width: 200px;           
        height: auto;
    }

    .icon { background-color: #eff6ff; width: 70px; height: 70px; border-radius: 50%; display: flex; justify-content: center; align-items: center; margin: 0 auto 20px; }
    .icon svg { color: #3b82f6; width: 35px; height: 35px; }


  
    .cards-wrapper { display: flex; gap: 20px; justify-content: center; padding: 50px; }
    .card { 
        background: white; 
        border: 1px solid #ddd; 
        border-radius: 8px; 
        padding: 40px; 
        text-align: center; 
        width: 300px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }
    .btn { 
        background: #001E4E; 
        color: white; 
        padding: 10px 20px; 
        text-decoration: none; 
        border-radius: 5px;
        display: inline-block;
        margin-top: 20px;
    }
</style>