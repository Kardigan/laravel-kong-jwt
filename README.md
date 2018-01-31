# Laravel Kong JWT

Package to read JWT claims sent through the JWT
plugin in Kong ((http://getkong.org)) to the upstream api.

It adds a middleware that pulls out all claims and
add them to the config under the key "claims".

## Installation

Add the package

```
composer require kardigan/laravel-kong-jwt

composer dump-autoload
```

Add the package to config/app.php under providers
```
Kardigan\LaravelKongJwt\ServiceProvider::class,
```

Add the middleware to app/Http/Kernel.php or set dynamically in your routes.

## Usage

If the x-consumer-custom-id is not set the middleware will return a 403 access denied.

Once the middleware is up and running you can access
all claims sent through with the JWT token like this:

```php
Config::get('claims');
```

The middleware are checking for a jwt token both in the header with the "authorization" key, or as a url parameter with the "token" key
