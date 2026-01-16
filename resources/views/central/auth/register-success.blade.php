<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Creado - SaaS</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body class="purple darken-1">
    <div class="container">
        <div class="row" style="padding-top: 10vh;">
            <div class="col s12 m10 offset-m1 l8 offset-l2">
                <div class="card">
                    <div class="card-content center-align">
                        <h2>✅</h2>
                        <h4 class="green-text text-darken-2">¡Tenant Creado!</h4>
                        <p class="grey-text">Tu nuevo tenant ha sido creado exitosamente. Ya puedes acceder a tu plataforma.</p>

                        <div class="card-panel purple lighten-5 left-align">
                            <p><strong><i class="material-icons tiny">info</i> Acceso a tu tenant:</strong></p>
                            @if(session('domain'))
                                <p>Tu dominio es: <strong>{{ session('domain') }}</strong></p>
                            @else
                                <p>Ahora puedes acceder a tu tenant desde cualquier lugar con el dominio que especificaste.</p>
                            @endif
                        </div>

                        <div class="card-panel grey lighten-4 left-align">
                            <h6><i class="material-icons tiny">list</i> Próximos pasos:</h6>
                            
                            <div class="collection">
                                <div class="collection-item">
                                    <span class="badge purple white-text circle">1</span>
                                    @if(session('domain'))
                                        Accede a: <code class="grey darken-3 white-text">http://{{ session('domain') }}:8000/login</code>
                                    @else
                                        Accede a tu tenant usando el dominio que creaste
                                    @endif
                                </div>
                                <div class="collection-item">
                                    <span class="badge purple white-text circle">2</span>
                                    Inicia sesión con el email y contraseña que proporcionaste
                                </div>
                                <div class="collection-item">
                                    <span class="badge purple white-text circle">3</span>
                                    ¡Listo! Ahora tienes acceso a tu dashboard
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-action center-align">
                        <a href="{{ route('central.home') }}" class="btn purple waves-effect waves-light">
                            <i class="material-icons left">home</i>
                            Volver al Inicio
                        </a>
                        <a href="{{ route('central.register') }}" class="btn-flat purple-text waves-effect">
                            <i class="material-icons left">add_business</i>
                            Crear Otro Tenant
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
