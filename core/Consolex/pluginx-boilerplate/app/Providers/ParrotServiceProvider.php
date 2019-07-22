<?php

namespace Parrotx\Plugx\App\Providers;

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
    public function boot(\Illuminate\Routing\Router $router,\Parrotx\Plugx\App\Http\ParrotKernel $ParrotKernel)
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

        /*
        |-----------------------------------------------------------------------------------
        | pluginx deactivated mode
        |-----------------------------------------------------------------------------------
        | return nothing
        */

        $pkgInfo = json_decode(file_get_contents(__DIR__.'/../../pluginx.json'));
        if ($pkgInfo->{'status'} === 'deactived') {
          return 0;
        }

        /*
        |-----------------------------------------------------------------------------------
        | pluginx activated mode
        |-----------------------------------------------------------------------------------
        |
        */

        $this->loadMigrationsFrom(
          __DIR__.'/../../database/migrations'
        );

        // load view
        $this->loadViewsFrom(__DIR__.'/../../bladex/views', 'plugxName');

        // load language
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'plugxName');



        // Manually register service providers
        $this->app->register('Parrotx\\Plugx\\App\\Providers\\RouteServiceProvider');

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


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /*
        |-----------------------------------------------------------------------------------
        | pluginx deactivated mode
        |-----------------------------------------------------------------------------------
        | return nothing
        */
        $pkgInfo = json_decode(file_get_contents(__DIR__.'/../../pluginx.json'));
        if ($pkgInfo->{'status'} === 'deactived') {
          return 0;
        }

        /*
        |-----------------------------------------------------------------------------------
        | pluginx activated mode
        |-----------------------------------------------------------------------------------
        |
        */

        // config register
        // https://medium.com/@koenhoeijmakers/properly-merging-configs-in-laravel-packages-a4209701746d
        $this->mergeConfigFrom(
          __DIR__.'/../../config/parrot.php','parrotx-config'
        );

        // register commands
        $this->commands($this->parrotCommands());
        //$this->commands($this->parrotCoreCommands());
    }

    /**
     * load Parrot commands
     *
     * @return array
     */
    public function parrotCommands(){
      $commandStore = [];
      foreach ((new Finder)->in(base_path('pluginx/plugx/app/Console/Command'))->files() as $command) {
        $commande = 'Parrotx\Plugx\App\Console\Command\\'.str_replace(
          ['/', '.php'],
          ['\\', ''],
          Str::after($command->getFilename(), DIRECTORY_SEPARATOR)
        );
        $commandStore[] = $commande;
      }
      return $commandStore;
    }

}
