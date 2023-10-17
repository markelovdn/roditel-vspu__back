<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = Role::where('code', 'superadmin')->first();
        $admin = User::where('id', auth()->user()->id)->first();

        if($admin->role_id != $role->id) {
            return response()->json([ 'message' => 'У вас нет доступа (SA) к данному ресурсу' ], 400);
        }

        return $next($request);
    }
}
