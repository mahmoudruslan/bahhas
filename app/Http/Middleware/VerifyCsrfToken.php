<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'http://localhost:8000/arb/response/fail',
        'http://localhost:8000/arb/response/success',
        'http://localhost:8000/arb/response',
        'http://localhost:8000/api/arb/response',
        'https://bhhath.basebackend.com/api/arb/response',
        'https://bhhath.basebackend.com/arb/response',
    ];
}
