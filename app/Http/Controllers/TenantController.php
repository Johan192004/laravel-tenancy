<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;

class TenantController extends Controller
{
    public function store(Request $request)
    {

        $tenant1 = Tenant::create(['id' => 'pedrito']);
        $tenant1->domains()->create(['domain' => 'pedrito.localhost']);
    }
}

