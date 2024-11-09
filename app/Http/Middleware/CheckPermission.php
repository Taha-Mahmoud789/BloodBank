<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the current route name
        $routeName = Route::currentRouteName();

        // Find the permission for this route
        $permission = Permission::whereRaw("FIND_IN_SET ('$routeName', routes)")->first();

        // Check if permission exists and user has it
        if ($permission && !$request->user()->can($permission->name)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
