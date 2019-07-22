<?php

namespace Parrot\Parrot\Core\Consolex\Command;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */

use Parrot\Parrot\Core\Consolex\GeneratorCommand;

class JobMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'p-m:job {name} {--pkg=} {--sync=}';

    /*
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Job class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Job';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return  $this->option('sync')
                          ? __DIR__.'/../stubs/job.stub'
                          : __DIR__.'/../stubs/job-queued.stub';
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
        $pkgNamespace = 'Parrotx\\'.ucfirst($package).'\App\Jobs';
        return $pkgNamespace;
      }
      return 'Parrot\Parrot\App\Jobs';
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
        $pkgPathName = 'pluginx/'.lcfirst($package).'/app/Jobs/';
        return base_path($pkgPathName);
      }
      return base_path('parrot/app/Jobs/');
    }


}
