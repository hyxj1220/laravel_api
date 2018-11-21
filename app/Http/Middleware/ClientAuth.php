<?php

namespace App\Http\Middleware;

use Closure;

class ClientAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // api key
        $api_key = config("api_config_v1.api_key");
        
        // api 公共参数
        $api_common = config("api_config_v1.api_common");
        if (!isset(config("api_config_v1.api_param")[$request->pathInfo])){

        }

        $api_param = config("api_config_v1.api_param")[$request->pathInfo];
        
        

        return $next($request);
    }
}
