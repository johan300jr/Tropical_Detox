<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Restablecer Contraseña</title>
        {{--
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Site Icons -->
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <!-- Site CSS -->
        <link rel="stylesheet" href="/css/style.css">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="/css/responsive.css">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="/css/custom.css">

        <style>
            /* Estilos para el contenedor de la animación de carga */
            #loader-wrapper {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: #f3f3f3;
                z-index: 9999;
                display: flex;
                justify-content: center;
                align-items: center;
            }
    
            /* Estilos para la animación de carga */
            #loader {
                border: 4px solid #3498db;
                border-top: 4px solid #f3f3f3;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                animation: spin 2s linear infinite; /* Animación giratoria */
            }
    
            /* Animación giratoria */
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            .custom-btn {
    background-color: rgb(116, 204, 58);
    /* Otros estilos que desees aplicar */
}

        </style>
    </head>


<body>
    <div id="loader-wrapper">
        <div id="loader"></div>
    </div>

    @include('cliente.nav')
    
<br>

<div class="container" style="padding-top: 60px;">
    <div class="card card-primary mx-auto" style="max-width: 400px;">
        <div class="card-header"><h4>Restablecer Contraseña</h4></div>

        <div class="card-body">
            @if (session('status'))
    <div class="alert alert-success">
        {{ trans('auth.sent') }}
        
    </div>
@endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email" tabindex="1" value="{{ old('email') }}" autofocus required>
                           @error('email')

                    <div class="invalid-feedback">
                        {{ trans('auth.email') }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg btn-block" tabindex="4" style="background-color: rgb(95, 180, 78);">Enviar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-5 text-muted text-center">
        ¿Recordaste tus datos de inicio de sesión? <a href="{{ route('login') }}">Iniciar sesión</a>
    </div>
</div>
    @include('cliente.footer')
    <script>
        window.addEventListener('load', function() {
            var loader = document.getElementById('loader-wrapper');
            loader.style.display = 'none';
        });
    </script>
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="/js/jquery.superslides.min.js"></script>
    <script src="/js/bootstrap-select.js"></script>
    <script src="/js/inewsticker.js"></script>
    <script src="/js/bootsnav.js."></script>
    <script src="/js/images-loded.min.js"></script>
    <script src="/js/isotope.min.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/baguetteBox.min.js"></script>
    <script src="/js/form-validator.min.js"></script>
    <script src="/js/contact-form-script.js"></script>
    <script src="/js/custom.js"></script>
    <!-- Aquí podrías agregar cualquier script necesario -->
</body>
</html>