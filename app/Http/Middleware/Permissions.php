<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use InfyOm\Generator\Utils\ResponseUtil;
use Response;


class Permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
        public function handle($request, Closure $next, $permission=null, $independent=null)
    {
        if($independent == null){
            $independent = $request->route('independent_id');
        }


        if(auth()->user()->hasPermissionTo($permission, $independent)) {
            return $next($request);
        }
        // if($permission !== null && !auth()->user()->can($permission)) {
        //     abort(403);
        // }
        // return $next($request);
        return Response::json(ResponseUtil::makeError('unauthorized'), 403);
        // return abort(403, 'unauthorized');
    }
}

