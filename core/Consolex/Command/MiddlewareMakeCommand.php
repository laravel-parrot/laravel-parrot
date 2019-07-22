<?php

namespace Parrot\Parrot\Core\Consolex\Command;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */
 
use Parrot\Parrot\Core\Consolex\GeneratorCommand;

class MiddlewareMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'p-m:middleware {name} {--pkg=}';

    /*
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Middleware class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'middleware';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../stubs/middleware.stub';
    }

    /**
     * set the namespace.
     *
     * @return string
     */

    protected function getNamespace()
    {
      if($this->option('pkg')){
        $package = $this->option('pkg');
        $pkgNamespace = 'Parrotx\\'.ucfirst($package).'\App\Http\Middleware';
        return $pkgNamespace;
      }
      return 'Parrot\Parrot\App\Http\Middleware';
    }
    /**
     * set the filepath.
     *
     * @return string
     */
    protected function getPath()
    {
      if($this->option('pkg')){
        $package = $this->option('pkg');
        $pkgPathName = 'pluginx/'.lcfirst($package).'/app/Http/Middleware/';
        return base_path($pkgPathName);
      }
      return base_path('parrot/app/Http/Middleware/');
    }


}
