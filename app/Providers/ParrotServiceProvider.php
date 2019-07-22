<?php

namespace Parrot\Parrot\App\Providers;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Symfony\Component\Finder\Finder;
use Illuminate\Support\Str;

class ParrotServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router,\Parrot\Parrot\App\Http\ParrotKernel $ParrotKernel)
    {
        // // get namespace
        // // Illuminate/Foundation/Application.php
        // $nameSpace = $this->app->getNamespace();
        // // Set namespace alias for AppController.
        // // Illuminate/Foundation/AliasLoader.php
        // AliasLoader::getInstance()->alias('AppController', $nameSpace.'Http\Controllers\Controller')

        // // load route <already has loaded by RouteServiceProvider>
        // $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');

        // load database
        $this->loadMigrationsFrom(
          __DIR__.'/../../database/migrations'
        );

        // load view
        $this->loadViewsFrom(__DIR__.'/../../bladex/views', 'parrot');

        // load language
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'parrot');

        // load middleware

        foreach ($ParrotKernel->routeMiddleware() as $key => $value) {
          $router->aliasMiddleware($key,$value);
        }

        foreach ($ParrotKernel->middlewareGroup() as $key => $value) {
          $router->middlewareGroup($key,$value);
        }

        foreach ($ParrotKernel->prependMiddlewareGroup() as $key => $value) {
          $router->prependMiddlewareToGroup($key,$value);
        }

        foreach ($ParrotKernel->middleware() as $key => $value) {
          $this->app->make('Illuminate\Contracts\Http\Kernel')->prependMiddleware($value);
        }

        //$router->aliasMiddleware('me','App\Http\Middleware\Me');
        //$router->prependMiddlewareToGroup('web','App\Http\Middleware\Me');
        //$this->app->make('Illuminate\Contracts\Http\Kernel')->prependMiddleware('App\Http\Middleware\Me::class');



        // Manually register service providers
        $this->app->register('Parrot\\Parrot\\App\\Providers\\RouteServiceProvider');

        // Manually load helpers
        include __DIR__.'/../../core/Helpers.php';

        if (file_exists(pluginx_path())) {
          foreach ((new Finder)->in(pluginx_path())->directories()->depth(0) as  $value){
            $directories = ucfirst($value->getFilename());

            $this->app->register('Parrotx\\'.$directories.'\\App\\Providers\\ParrotServiceProvider');
          }
        }


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // config register
        // https://medium.com/@koenhoeijmakers/properly-merging-configs-in-laravel-packages-a4209701746d
        $this->mergeConfigFrom(
          __DIR__.'/../../config/parrot.php','parrot'
        );

        // register commands
        $this->commands($this->parrotCommands());
        $this->commands($this->parrotCoreCommands());
    }

    /**
     * load Parrot commands
     *
     * @return array
     */
    public function parrotCommands(){
      $commandStore = [];
      foreach ((new Finder)->in(base_path('parrot/app/Console/Command'))->files() as $command) {
        $commande = 'Parrot\Parrot\App\Console\Command\\'.str_replace(
          ['/', '.php'],
          ['\\', ''],
          Str::after($command->getFilename(), DIRECTORY_SEPARATOR)
        );
        $commandStore[] = $commande;
      }
      return $commandStore;
    }

    /**
     * load Parrot core commands
     *
     * @return array
     */
    public function parrotCoreCommands(){
      $commandStore = [];
      foreach ((new Finder)->in(base_path('parrot/core/Consolex/Command'))->files() as $command) {
        $commande = 'Parrot\Parrot\Core\Consolex\Command\\'.str_replace(
          ['/', '.php'],
          ['\\', ''],
          Str::after($command->getFilename(), DIRECTORY_SEPARATOR)
        );
        $commandStore[] = $commande;
      }
      return $commandStore;
    }
}
