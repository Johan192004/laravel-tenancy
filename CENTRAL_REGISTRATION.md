# Sistema de Registro de Tenants - Dominio Central

## ¿Cómo funciona?

El sistema permite crear nuevos tenants desde el **dominio central** (localhost o tu dominio principal). Cada tenant incluye:

- Su propio **dominio**
- Su propia **base de datos**
- Su propio **usuario administrador**

---

## Rutas Disponibles (Dominio Central)

| Ruta | Método | Descripción |
|------|--------|-------------|
| `/` | GET | Página de inicio |
| `/register` | GET | Formulario para crear tenant |
| `/register` | POST | Procesar creación de tenant |
| `/register/success` | GET | Página de confirmación |

---

## Pasos para crear un Tenant

### 1. **Acceder a la página de registro**
```
http://localhost/register
```

### 2. **Completar el formulario**

**Datos del Tenant:**
- **Nombre del Tenant**: Ej: "Mi Empresa"
- **Dominio**: Ej: "miempresa.localhost" o "miempresa.miapp.com"

**Datos del Administrador:**
- **Nombre Completo**: Ej: "Juan Pérez"
- **Email**: Ej: "juan@empresa.com"
- **Contraseña**: Debe tener al menos 8 caracteres con mayúscula, minúscula, número y símbolo

### 3. **Enviar el formulario**

El sistema automáticamente:
1. Crea el tenant en la base de datos central
2. Crea el dominio para el tenant
3. Crea la base de datos del tenant
4. Ejecuta las migraciones en la BD del tenant
5. Crea el usuario administrador en la BD del tenant

### 4. **Acceder al Tenant**
```
http://miempresa.localhost/login
```

Usa las credenciales que proporcionaste en el registro.

---

## Estructura de Base de Datos

### Base de Datos Central
- `tenants` → Información de los tenants
- `domains` → Dominios asociados a cada tenant

### Base de Datos de cada Tenant
- `users` → Usuarios de ese tenant
- `password_reset_tokens` → Tokens para recuperar contraseña
- `sessions` → Sesiones de usuarios

---

## Validaciones

El formulario valida:

✅ **Tenant Name**
- Requerido
- Máximo 255 caracteres

✅ **Tenant Domain**
- Requerido
- Máximo 255 caracteres
- **Único** → No puede haber dos tenants con el mismo dominio

✅ **User Name**
- Requerido
- Máximo 255 caracteres

✅ **User Email**
- Requerido
- Debe ser un email válido
- Máximo 255 caracteres

✅ **Password**
- Requerido
- Mínimo 8 caracteres
- Debe contener mayúscula, minúscula, número y símbolo
- Confirmación debe coincidir

---

## Localización de Archivos

```
app/Http/Controllers/Central/
├── TenantRegistrationController.php    ← Controlador principal

routes/
├── web.php                              ← Rutas del dominio central

resources/views/central/
├── welcome.blade.php                   ← Página de inicio
└── auth/
    ├── register.blade.php              ← Formulario de registro
    └── register-success.blade.php      ← Página de éxito
```

---

## Flujo del Registro

```
┌─────────────────────┐
│ Usuario accede a    │
│ /register en el     │
│ dominio central     │
└──────────┬──────────┘
           │
           ▼
┌─────────────────────┐
│ Completa formulario │
│ y envía POST        │
└──────────┬──────────┘
           │
           ▼
┌─────────────────────────────┐
│ TenantRegistrationController│
│ valida los datos            │
└──────────┬──────────────────┘
           │
           ▼
    ┌──────────────┐
    │ ¿Válidos?    │
    └┬─────────┬───┘
     │ No      │ Sí
     ▼         ▼
  Error    ┌──────────────────────┐
  Message  │ Crea tenant en BD    │
           │ central              │
           └──────────┬───────────┘
                      │
                      ▼
           ┌──────────────────────┐
           │ Crea dominio para el │
           │ tenant               │
           └──────────┬───────────┘
                      │
                      ▼
           ┌──────────────────────┐
           │ Ejecuta migraciones  │
           │ en BD del tenant     │
           └──────────┬───────────┘
                      │
                      ▼
           ┌──────────────────────┐
           │ Crea usuario admin   │
           │ en BD del tenant     │
           └──────────┬───────────┘
                      │
                      ▼
           ┌──────────────────────┐
           │ Redirige a página    │
           │ de éxito             │
           └──────────────────────┘
```

---

## Notas Importantes

1. **Dominio único**: Cada tenant debe tener un dominio único en el sistema.

2. **Base de datos automática**: El sistema crea y configura automáticamente la BD del tenant.

3. **Migraciones automáticas**: Se ejecutan automáticamente en la BD del tenant.

4. **Contraseña hasheada**: Las contraseñas se almacenan hasheadas (no en texto plano).

5. **Aislamiento**: Cada tenant tiene su propia BD completamente aislada.

6. **Escalabilidad**: Puedes crear tantos tenants como necesites sin limitaciones técnicas.

---

## Troubleshooting

### Error: "Este dominio ya está registrado"
→ El dominio que intentaste usar ya existe. Elige otro diferente.

### Error: "Las contraseñas no coinciden"
→ Verifica que ambas contraseñas sean idénticas.

### Error al crear el tenant
→ Verifica que tu configuración de base de datos es correcta en `.env`.

### No puedo acceder a mi tenant después de crearlo
→ Asegúrate de que:
   - El dominio está configurado correctamente en tu archivo hosts (/etc/hosts)
   - El dominio resuelve correctamente (ej: 127.0.0.1  miempresa.localhost)
