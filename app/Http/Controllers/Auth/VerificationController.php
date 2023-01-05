<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerificationController extends Middleware
{
    /** 
    * The URIs that should be excluded from CSRF verification.
    *
    * @var array<int, string>
    */
   protected $except = [
       '/api/logout',
       '/api/register',
       '/api/login',
   ];
}
