<div class="container">
    <div class="logo">
       
    </div>

    <div class="cards-wrapper">
        <div class="card">
            <div class="icon"></div>
            <h3>Administrador</h3>
            <a href="{{ route('login') }}" class="btn">Acceder como Admin</a>
        </div>

        <div class="card">
            <div class="icon"></div>
            <h3>Vendedor</h3>
            <a href="{{ route('login') }}" class="btn">Acceder como Vendedor</a>
        </div>
    </div>
</div>

<style>

   body {
    font-family: 'Hero', sans-serif;
   }

    /* Estilos rápidos para igualar tu imagen */
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
        background: #2d3748; 
        color: white; 
        padding: 10px 20px; 
        text-decoration: none; 
        border-radius: 5px;
        display: inline-block;
        margin-top: 20px;
    }
</style>