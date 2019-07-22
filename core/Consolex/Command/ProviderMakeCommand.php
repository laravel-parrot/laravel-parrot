<?php

namespace Parrot\Parrot\Core\Consolex\Command;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */

use Parrot\Parrot\Core\Consolex\GeneratorCommand;

class ProviderMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'p-m:provider {name} {--pkg=}';

    /*
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new provider class ';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Proviver';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../stubs/provider.stub';
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
        $pkgNamespace = 'Parrotx\\'.ucfirst($package).'\App\Providers';
        return $pkgNamespace;
      }
      return 'Parrot\Parrot\App\Providers';
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
        $pkgPathName = 'pluginx/'.lcfirst($package).'/app/Providers/';
        return base_path($pkgPathName);
      }
      return base_path('parrot/app/Providers/');
    }


}
