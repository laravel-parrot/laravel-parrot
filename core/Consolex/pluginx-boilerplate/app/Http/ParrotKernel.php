<?php

namespace Parrotx\Plugx\App\Http;

class ParrotKernel
{
  function middleware(){
    $middleware = [
      //\App\Http\Middleware\Me::class,

    ];
    return $middleware;
  }

  function routeMiddleware(){
    $routerMiddlware = [
      //'me' => \App\Http\Middleware\Me::class,
    ];
    return $routerMiddlware;
  }

  function prependMiddlewareGroup(){
    $middlewareGroup = [
      //'web' => \Parrot\Parrot\Middleware\Name::class,
    ];
    return $middlewareGroup;
  }

  function MiddlewareGroup(){
    $middlewareGroup = [
      'parrot' => [
        // \App\Http\Middleware\Me::class,
      ]
    ];
    return $middlewareGroup;
  }

}

 ?>
