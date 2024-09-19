<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'api/crear-cargos',
        'api/actualizar-cargos/*',
        'api/eliminar-cargos/*',
        'api/crear-departamentos',
        'api/actualizar-departamentos/*',
        'api/eliminar-departamentos/*',
        'api/crear-users',
        'api/actualizar-users/*',
        'api/eliminar-users/*',
    ];
}
