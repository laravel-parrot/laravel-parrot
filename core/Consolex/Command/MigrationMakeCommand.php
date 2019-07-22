<?php

namespace Parrot\Parrot\Core\Consolex\Command;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */

use Parrot\Parrot\Core\Consolex\GeneratorMigrationCommand;

class MigrationMakeCommand extends GeneratorMigrationCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'p-m:migrations {name} {--create=} {--pkg=}';

    /*
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Migration class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../stubs/migration-create.stub';
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
        $pkgNamespace = 'Parrotx\\'.ucfirst($package).'\App\Http\Model';
        return $pkgNamespace;
      }
      return 'Parrot\Parrot\App\Http\Model';
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
        $pkgPathName = 'pluginx/'.lcfirst($package).'/database/migrations/';
        return base_path($pkgPathName);
      }
      return base_path('parrot/database/migrations/');
    }
}
