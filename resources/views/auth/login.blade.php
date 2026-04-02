@extends('layouts.auth')

@section('content')
    <h2>Acceso </h2>
    <p>Ingrese sus credenciales</p>

    @if($errors->any())
        <div class="error-alert">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label>Usuario</label>
            <input type="text" name="codigo" value="{{ old('codigo') }}" inputmode="numeric" 
            maxlength="6" required autofocus>
            
        </div>

        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" class="btn-submit">
            Iniciar Sesión
        </button>
    </form>
@endsection