<?php

namespace App\Http\Middleware;

use Closure;

class SekumMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($request->user() && $request->user()->jabatan == 'sekum') {
            return $next($request);
            
        }
            return $arrayName = array('status' => 'error' , 'pesan' => 'Hanya Sekretaris Umum' );
            
        }
    }
