<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class CookieCheck
{
    public function handle(Request $request, Closure $next)
    {
        $userControllerObj = new UserController();
        if($userControllerObj->checkAccess($request) != 1)
            return View::make('errors.nocookie');
        return $next($request);
    }
}
