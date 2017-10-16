<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/29
 * Time: 13:59
 */

namespace App\Http\Middleware;

use Closure;

class Backend
{
    public function handle($request, Closure $next)
    {
        if (!$request->session()->get('backend_user')) {
            return redirect(route('backendLogin'));
        }

        return $next($request);
    }
}