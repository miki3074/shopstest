<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Проверяем: залогинен ли юзер и совпадает ли его email
        if (auth()->check() && auth()->user()->email === 'miki23074@gmail.com') {
            return $next($request);
        }

        // Если нет - выдаем ошибку 403 (Доступ запрещен)
        abort(403, 'У вас нет прав доступа к этой странице.');
    }
}
