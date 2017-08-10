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
        $enabled = env('LARAVEL_KONG_JWT_ENABLED', true);
		
		if(!$enabled)
		{
			return $next($request);
		}
		
		
		
		if(!$request->hasHeader('x-consumer-custom-id'))
        {
          abort(403, 'Access denied');
        }

        if($request->hasHeader('authorization'))
        {
            $jwt = new Jwt();

            $raw_claims = $jwt->base64Decode($request->header('authorization'));

            Config::set('claims', $jwt->getClaims($raw_claims));
        }

        return $next($request);
    }


}
