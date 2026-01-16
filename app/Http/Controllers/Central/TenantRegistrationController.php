<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Validation\Rules\Password;

class TenantRegistrationController extends Controller
{
    /**
     * Mostrar el formulario de registro de tenant
     */
    public function showRegistrationForm()
    {
        return view('central.auth.register');
    }

    /**
     * Procesar el registro de un nuevo tenant
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'tenant_name' => ['required', 'string', 'max:255'],
            'tenant_domain' => ['required', 'string', 'max:255', 'unique:domains,domain'],
            'user_name' => ['required', 'string', 'max:255'],
            'user_email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ], [
            'tenant_name.required' => 'El nombre del tenant es obligatorio.',
            'tenant_domain.required' => 'El dominio es obligatorio.',
            'tenant_domain.unique' => 'Este dominio ya está registrado.',
            'user_name.required' => 'El nombre del usuario es obligatorio.',
            'user_email.required' => 'El email es obligatorio.',
            'user_email.email' => 'El email no es válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        // Asegurarse de que el dominio tenga .localhost si no lo tiene
        $domain = $validated['tenant_domain'];
        if (!str_contains($domain, '.')) {
            $domain = $domain . '.localhost';
        }

        try {
            // Crear el tenant
            $tenant = Tenant::create([
                'id' => $this->generateTenantId($validated['tenant_name']),
            ]);

            // Crear el dominio para el tenant
            $tenant->domains()->create([
                'domain' => $domain,
            ]);

            // Ejecutar migraciones para el nuevo tenant
            $tenant->run(function () use ($validated) {
                Artisan::call('migrate', [
                    '--database' => 'tenant',
                    '--force' => true,
                ]);

                // Crear el usuario dentro del contexto del tenant
                User::create([
                    'name' => $validated['user_name'],
                    'email' => $validated['user_email'],
                    'password' => Hash::make($validated['password']),
                ]);
            });

            return redirect()->route('central.registration.success')
                ->with('success', '¡Tenant creado exitosamente!')
                ->with('domain', $domain);
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error al crear el tenant: ' . $e->getMessage()]);
        }
    }

    /**
     * Página de éxito
     */
    public function success()
    {
        return view('central.auth.register-success');
    }

    /**
     * Generar un ID único para el tenant basado en el nombre
     */
    private function generateTenantId(string $name): string
    {
        $slug = \Illuminate\Support\Str::slug($name);
        $id = $slug;
        $counter = 1;

        while (Tenant::where('id', $id)->exists()) {
            $id = $slug . '-' . $counter;
            $counter++;
        }

        return $id;
    }
}
