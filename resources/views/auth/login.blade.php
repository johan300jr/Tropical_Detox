
@include('cliente.nav')

@extends('layouts.auth_app')
@section('title')
    Inicio de sesion
@endsection
@section('content')
<div class="card card-primary form-border">
        <div class="card-header"><h2>Inicio de sesion</h2></div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger p-0">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label for="email">Email</label>
                    <input aria-describedby="emailHelpBlock" id="email" type="email"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                           placeholder="ingrese su Email" tabindex="1"
                           value="{{ (Cookie::get('email') !== null) ? Cookie::get('email') : old('email') }}" autofocus
                           required>
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Contraseña</label>
                        
                    </div>
                    <div class="input-group"> <!-- Agregamos una div con la clase "input-group" -->
                        <input aria-describedby="passwordHelpBlock" id="password" type="password"
                               value="{{ (Cookie::get('password') !== null) ? Cookie::get('password') : null }}"
                               placeholder="ingrese su contraseña"
                               class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}" name="password"
                               tabindex="2" required>
                        <div class="input-group-append"> <!-- Agregamos una div con la clase "input-group-append" -->
                            <span class="input-group-text" style="cursor: pointer;" onclick="togglePasswordVisibility()">
                                <i class="fas fa-eye" id="togglePasswordIcon"></i> <!-- Icono de ojo -->
                            </span>
                        </div>
                    </div>
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                    
                </div>
                <div class="d-block">
                    
                    <div class="float-right">
                        <a href="{{ route('password.request') }}" class="text-small">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                </div>
                

                <script>
                    function togglePasswordVisibility() {
                        var passwordInput = document.getElementById('password');
                        var passwordIcon = document.getElementById('togglePasswordIcon');
                
                        if (passwordInput.type === 'password') {
                            passwordInput.type = 'text';
                            passwordIcon.classList.remove('fa-eye');
                            passwordIcon.classList.add('fa-eye-slash');
                        } else {
                            passwordInput.type = 'password';
                            passwordIcon.classList.remove('fa-eye-slash');
                            passwordIcon.classList.add('fa-eye');
                        }
                    }
                </script>


                <br>
                
                {{-- <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                               id="remember"{{ (Cookie::get('remember') !== null) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">Recuerdame</label>
                    </div>
                </div> --}}

                <div class="form-group">
                    <button id="miBoton" type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Iniciar Sesión
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-5 text-muted text-center">
        ¿No estas registrado? <a
                href="{{ route('register') }}">Registrate</a>
    </div>
    
    
    
@endsection

