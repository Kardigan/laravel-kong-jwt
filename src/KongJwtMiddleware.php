<?php namespace Kardigan\LaravelKongJwt;

use Closure;
use Illuminate\Support\Facades\Config;

class KongJwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if($request->hasHeader('authorization'))
        {
            $jwt = new Jwt();

            $raw_claims = $jwt->base64Decode($request->header('authorization'));

            Config::set('claims', $jwt->getClaims($raw_claims));
        }

        return $next($request);
    }


}