<?php

namespace Parrot\Parrot\Core\Consolex\Command;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */

use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\Command as Command;

class PluginxActiveCommand extends Command
{
    protected $signature = 'p-pluginx:active {name}';
    protected $description = 'make pluginx active';

    /**
     * Create a new controller creator command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle(){
      $package = $this->argument('name');
      $path = pluginx_path($package.'/pluginx.json');

      $this->files->put($path, $this->buildClass());
      echo exec('composer dump-autoload');

      $this->info($package.' pluginx now actived');
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass()
    {
      $package = $this->argument('name');
      $stub = $this->files->get(pluginx_path($package.'/pluginx.json'));

      return $this->replaceNamespace($stub);
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub)
    {
      if (! str_contains($stub,'"status": "actived"')) {
        $stub = str_replace(
            [
              '"status": "deactived"'
            ],
            [
              '"status": "actived"'
            ],
            $stub
        );
      }
        return $stub;
    }
}
