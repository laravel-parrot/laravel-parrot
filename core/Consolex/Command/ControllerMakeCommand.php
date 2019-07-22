<?php

namespace Parrot\Parrot\Core\Consolex\Command;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */

use Parrot\Parrot\Core\Consolex\GeneratorCommand;

class ControllerMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'p-m:controller {name} {--pkg=}';

    /*
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Controller class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../stubs/controller.stub';
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
        $pkgNamespace = 'Parrotx\\'.ucfirst($package).'\App\Http\Controllers';
        return $pkgNamespace;
      }
      return 'Parrot\Parrot\App\Http\Controllers';
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
        $pkgPathName = 'pluginx/'.lcfirst($package).'/app/Http/Controllers/';
        return base_path($pkgPathName);
      }
      return base_path('parrot/app/Http/Controllers/');
    }


}
