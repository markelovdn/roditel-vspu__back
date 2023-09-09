<?php

namespace App\Http\Middleware;

use App\Models\Consultant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConsultantMidleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $consultant = Consultant::with('user')->where('user_id', auth()->user()->id)->first();

        if($request->path() != 'consultant/'.$consultant->id) {
            return redirect('consultant/'.$consultant->id);
        }

        return $next($request);
    }
}
