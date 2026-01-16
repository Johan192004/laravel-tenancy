# Laravel Multi-Tenant SaaS Application

A multi-tenant SaaS application built with Laravel and [stancl/tenancy](https://tenancyforlaravel.com/) package. Each tenant has its own isolated database and domain.

## Features

- **Multi-Tenancy** - Complete tenant isolation with separate databases
- **Authentication** - Session-based login/logout for each tenant
- **Tenant Registration** - Self-service tenant creation with admin user
- **Materialize CSS** - Modern UI with Material Design components
- **Custom Domains** - Each tenant gets their own subdomain

## Requirements

- PHP 8.2+
- Composer
- MySQL / MariaDB / PostgreSQL
- Node.js & NPM (for assets)

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Johan192004/laravel-tenancy.git
   cd laravel-tenancy
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   
   Update your `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravel_central
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Start the development server**
   ```bash
   php artisan serve
   ```

## Usage

### Creating a Tenant

1. Navigate to `http://localhost:8000`
2. Click on "Create Tenant"
3. Fill in the tenant information:
   - Tenant name
   - Domain (e.g., `mycompany.localhost`)
   - Admin user details
4. After creation, access your tenant at `http://mycompany.localhost:8000/login`

### Tenant Login

Each tenant has its own authentication system. Users can log in at:
```
http://{tenant-domain}:8000/login
```

## Project Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── Auth/              # Tenant authentication
│   │   └── Central/           # Central app controllers
│   └── Models/
│       ├── Tenant.php         # Tenant model
│       └── User.php           # User model
├── database/
│   └── migrations/
│       ├── tenant/            # Tenant-specific migrations
│       └── ...                # Central migrations
├── resources/views/
│   ├── auth/                  # Login views
│   ├── central/               # Central app views
│   │   └── auth/              # Registration views
│   └── dashboard.blade.php    # Tenant dashboard
└── routes/
    ├── tenant.php             # Tenant routes
    └── web.php                # Central routes
```

## Tech Stack

- **Backend**: Laravel 11
- **Multi-Tenancy**: stancl/tenancy
- **Frontend**: Materialize CSS 1.0
- **Icons**: Material Icons
- **Database**: MySQL (configurable)

## Routes

### Central Application
| Method | URI | Description |
|--------|-----|-------------|
| GET | `/` | Welcome page |
| GET | `/register` | Tenant registration form |
| POST | `/register` | Create new tenant |

### Tenant Application
| Method | URI | Description |
|--------|-----|-------------|
| GET | `/login` | Login form |
| POST | `/login` | Authenticate user |
| POST | `/logout` | Logout user |
| GET | `/dashboard` | Tenant dashboard |

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
