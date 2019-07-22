<?php

namespace Parrot\Parrot\Core\Consolex\Command;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */
 
use Parrot\Parrot\Core\Consolex\GeneratorCommand;

class NotificationMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'p-m:notification {name} {--pkg=} {--markdown}';

    /*
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Notification class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Notification';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->option('markdown')
                        ? __DIR__.'/../stubs/markdown-notification.stub'
                        : __DIR__.'/../stubs/notification.stub';
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
        $pkgNamespace = 'Parrotx\\'.ucfirst($package).'\App\Notifications';
        return $pkgNamespace;
      }
      return 'Parrot\Parrot\App\Notifications';
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
        $pkgPathName = 'pluginx/'.lcfirst($package).'/app/Notifications/';
        return base_path($pkgPathName);
      }
      return base_path('parrot/app/Notifications/');
    }


}
