<?php

namespace App\Library;

use App\Providers\AppServiceProvider;
use App\Providers\AuthServiceProvider;
use App\Providers\EventServiceProvider;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Dingo\Api\Provider\LumenServiceProvider;
use Illuminate\Redis\RedisServiceProvider;

class Application extends \Laravel\Lumen\Application
{

    public function __construct($basePath = null)
    {
        parent::__construct($basePath);
        $this->registerApplication();
        $this->registerLocalDev();
    }

    private function registerApplication()
    {
        $this->withFacades();

        $this->withEloquent();

        /*
        |--------------------------------------------------------------------------
        | Register Container Bindings
        |--------------------------------------------------------------------------
        |
        | Now we will register a few bindings in the service container. We will
        | register the exception handler and the console kernel. You may add
        | your own bindings here if you like or you can make another file.
        |
        */

        $this->singleton(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            \App\Exceptions\Handler::class
        );

        $this->singleton(
            \Illuminate\Contracts\Console\Kernel::class,
            \App\Console\Kernel::class
        );

        /*
        |--------------------------------------------------------------------------
        | Register Middleware
        |--------------------------------------------------------------------------
        |
        | Next, we will register the middleware with the application. These can
        | be global middleware that run before and after each request into a
        | route or middleware that'll be assigned to some specific routes.
        |
        */

        // $app->middleware([
        //    App\Http\Middleware\ExampleMiddleware::class
        // ]);

        // $app->routeMiddleware([
        //     'auth' => App\Http\Middleware\Authenticate::class,
        // ]);

        /*
        |--------------------------------------------------------------------------
        | Register Service Providers
        |--------------------------------------------------------------------------
        |
        | Here we will register all of the application's service providers which
        | are used to bind services into the container. Service providers are
        | totally optional, so you are not required to uncomment this line.
        |
        */

        $this->register(AppServiceProvider::class);
        $this->register(AuthServiceProvider::class);
        $this->register(EventServiceProvider::class);

        $this->register(RedisServiceProvider::class);

        $this->register(LumenServiceProvider::class);

    }

    private function registerLocalDev()
    {
        if (app()->environment('local')) {
            $this->register(IdeHelperServiceProvider::class);
        }
    }
}