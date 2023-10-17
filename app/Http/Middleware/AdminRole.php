<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $roleSA = Role::where('code', 'superadmin')->first();
        $admin = User::where('id', auth()->user()->id)->first();

        if($admin->role_id != $role->id & $role->id != $roleSA->id) {
            return response()->json([ 'message' => 'У вас нет доступа (A) к данному ресурсу' ], 400);
        }

        return $next($request);
    }
}
