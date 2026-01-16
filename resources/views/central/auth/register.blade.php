<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Tenant - SaaS</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body class="purple darken-1">
    <div class="container">
        <div class="row" style="padding-top: 5vh;">
            <div class="col s12 m10 offset-m1 l8 offset-l2">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center-align">
                            <i class="material-icons medium purple-text">business</i>
                        </span>
                        <h5 class="center-align">Crear Nuevo Tenant</h5>
                        <p class="center-align grey-text">Completa el formulario para crear tu propio espacio</p>

                        @if ($errors->any())
                            <div class="card-panel red lighten-4 red-text text-darken-4">
                                <ul class="browser-default">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="card-panel green lighten-4 green-text text-darken-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('central.register.store') }}" method="POST">
                            @csrf

                            <h6 class="purple-text"><i class="material-icons tiny">domain</i> Información del Tenant</h6>
                            <div class="divider"></div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">business</i>
                                    <input type="text" id="tenant_name" name="tenant_name" value="{{ old('tenant_name') }}" required autofocus class="validate">
                                    <label for="tenant_name">Nombre del Tenant</label>
                                    <span class="helper-text">Ej: Mi Empresa</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">language</i>
                                    <input type="text" id="tenant_domain" name="tenant_domain" value="{{ old('tenant_domain') }}" required class="validate">
                                    <label for="tenant_domain">Dominio</label>
                                    <span class="helper-text">Ej: miempresa.localhost o miempresa.miapp.com</span>
                                </div>
                            </div>

                            <h6 class="purple-text"><i class="material-icons tiny">admin_panel_settings</i> Administrador del Tenant</h6>
                            <div class="divider"></div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">person</i>
                                    <input type="text" id="user_name" name="user_name" value="{{ old('user_name') }}" required class="validate">
                                    <label for="user_name">Nombre Completo</label>
                                    <span class="helper-text">Ej: Juan Pérez</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">email</i>
                                    <input type="email" id="user_email" name="user_email" value="{{ old('user_email') }}" required class="validate">
                                    <label for="user_email">Correo Electrónico</label>
                                    <span class="helper-text">Ej: juan@empresa.com</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">lock</i>
                                    <input type="password" id="password" name="password" required class="validate">
                                    <label for="password">Contraseña</label>
                                    <span class="helper-text">Mínimo 8 caracteres, debe incluir mayúscula, minúscula, número y símbolo</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">lock_outline</i>
                                    <input type="password" id="password_confirmation" name="password_confirmation" required class="validate">
                                    <label for="password_confirmation">Confirmar Contraseña</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12">
                                    <button type="submit" class="btn-large purple waves-effect waves-light col s12">
                                        <i class="material-icons left">add_business</i>
                                        Crear Tenant
                                    </button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12 center-align">
                                    <a href="{{ route('central.home') }}" class="purple-text">
                                        <i class="material-icons tiny">arrow_back</i>
                                        Volver al inicio
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
