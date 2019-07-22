<?php

namespace Parrot\Parrot\App\Http;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */
 
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
        //\App\Http\Middleware\Me::class,
      ]
    ];
    return $middlewareGroup;
  }

}

 ?>
