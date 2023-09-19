<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ParentedRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = Role::where('code', Role::PARENTED)->first();
        $consultant = User::where('id', auth()->user()->id)->first();

        if($consultant->role_id != $role->id) {
            return response()->json([ 'message' => 'У вас нет доступа к данному ресурсу' ], 401);
        }

        return $next($request);
    }
}
