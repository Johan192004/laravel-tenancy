# Sistema de Login por Tenant

## Pasos para implementar y usar:

### 1. **Ejecutar migraciones**
```bash
php artisan migrate --database=central  # Para la BD central
php artisan migrate                     # Para la BD del tenant
```

### 2. **Ejecutar seeders** (opcional, para crear usuario de prueba)
```bash
php artisan db:seed  # Si estás en el contexto del tenant
```

### 3. **Crear un tenant**
```bash
php artisan tinker

# Dentro de tinker:
$tenant = App\Models\Tenant::create(['id' => 'pedrito']);
$tenant->domains()->create(['domain' => 'pedrito.localhost']);
exit
```

### 4. **Crear usuarios en la BD del tenant**

**Opción A: Usando tinker**
```bash
php artisan tinker

# Dentro de tinker:
use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::create([
    'name' => 'Mi Usuario',
    'email' => 'usuario@example.com',
    'password' => Hash::make('micontraseña'),
]);
exit
```

**Opción B: Usando un controlador o comando**

### 5. **Acceder al login**
- Ve a: `http://pedrito.localhost/login`
- Email: `user@test.com`
- Contraseña: `password123`

---

## Rutas disponibles:

| Ruta | Método | Descripción |
|------|--------|-------------|
| `/login` | GET | Mostrar formulario de login |
| `/login` | POST | Procesar login |
| `/logout` | POST | Cerrar sesión |
| `/dashboard` | GET | Panel protegido (requiere auth) |

---

## Notas importantes:

1. **Isolamiento por tenant**: Cada tenant tiene su propia BD, por lo que los usuarios están completamente aislados.

2. **Middleware `auth`**: Las rutas protegidas usan `->middleware('auth')`.

3. **Guardia de autenticación**: Se usa la guardia `web` por defecto configurada en `config/auth.php`.

4. **Sesiones**: Las sesiones se almacenan en la BD del tenant automáticamente.

5. **Contraseña hasheada**: Usa `Hash::make()` para hashear contraseñas antes de guardar.

---

## Seguridad recomendada:

1. **CSRF Protection**: Ya está habilitada en todos los formularios con `@csrf`

2. **Validación**: Se validan email y contraseña en el servidor

3. **Rate limiting**: (Opcional) Puedes agregar throttling:
   ```php
   Route::post('/login', [TenantLoginController::class, 'login'])
       ->middleware('throttle:6,1')
       ->name('login.store');
   ```

4. **Contraseña olvidada**: Si necesitas agregar recuperación de contraseña, consulta la documentación de Laravel Fortify.
