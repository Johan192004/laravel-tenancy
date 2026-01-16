<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body class="grey lighten-4">
    <nav class="purple darken-1">
        <div class="nav-wrapper container">
            <a href="#" class="brand-logo">Dashboard</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><span>{{ Auth::user()->email }}</span></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn-flat white-text waves-effect waves-light">
                            <i class="material-icons left">exit_to_app</i>Cerrar Sesión
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="section">
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">
                                <i class="material-icons left purple-text">person</i>
                                ¡Bienvenido {{ Auth::user()->name }}!
                            </span>
                            <p class="grey-text">Has iniciado sesión exitosamente en el tenant.</p>
                        </div>
                        <div class="card-action">
                            <a href="#" class="purple-text">Ver perfil</a>
                            <a href="#" class="purple-text">Configuración</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12 m4">
                    <div class="card purple darken-1 white-text">
                        <div class="card-content">
                            <span class="card-title"><i class="material-icons">people</i></span>
                            <h4>0</h4>
                            <p>Usuarios Activos</p>
                        </div>
                    </div>
                </div>
                <div class="col s12 m4">
                    <div class="card blue darken-2 white-text">
                        <div class="card-content">
                            <span class="card-title"><i class="material-icons">folder</i></span>
                            <h4>0</h4>
                            <p>Proyectos</p>
                        </div>
                    </div>
                </div>
                <div class="col s12 m4">
                    <div class="card teal white-text">
                        <div class="card-content">
                            <span class="card-title"><i class="material-icons">trending_up</i></span>
                            <h4>0%</h4>
                            <p>Crecimiento</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="page-footer purple darken-1">
        <div class="container">
            <div class="row">
                <div class="col s12 center-align">
                    <p class="grey-text text-lighten-4">© {{ date('Y') }} SaaS Multi-Tenant. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
