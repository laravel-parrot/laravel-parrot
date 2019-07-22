<?php

namespace Parrot\Parrot\Core\Consolex\Command;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */
 
use Illuminate\Console\Command;
use Symfony\Component\Finder\Finder;
use Illuminate\Filesystem\Filesystem;

class MakePluginxCommand extends Command
{
  protected $signature = 'p-m:pkg {name}';
  protected $description = 'create new parrot pluginx';

  protected $files;

  public function  __construct(Filesystem $files)
  {
    parent::__construct();
    $this->files = $files;
  }

  public function handle(){

    $path = lcfirst($this->argument('name'));

    // check pluginx exist or not
    if (file_exists(pluginx_path($path))) {
      $this->info('This pluginx already exists');
      return ;
    }
    // make directory
    $this->files->makeDirectory(pluginx_path($path), 0777, true, true);
    // coping pluginx_boilerplate to new package
    $this->files->copyDirectory(parrot_path('core/Consolex/pluginx-boilerplate'),pluginx_path($path));
    $this->renameDummy();
    $this->info("done !! your pluginx is ".$path);


  }

  public function renameDummy()
  {
    $selectedFile = [
      'composer.json',
      'pluginx.json',
      'app/Providers/ParrotServiceProvider.php',
      'app/Providers/RouteServiceProvider.php',
      'app/Http/Controllers/Controller.php',
      'app/Http/ParrotKernel.php',
    ];

    foreach ($selectedFile as $key => $value) {
      $pkgPath = pluginx_path(lcfirst($this->argument('name')).'/'.$value);
      $this->files->put($pkgPath, $this->buildClass($pkgPath));
    }

  }

  protected function buildClass($pkgPath)
  {
      $stub = $this->files->get($pkgPath);

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
     $Plugx = ucfirst($this->argument('name'));
     $smallPlugx = lcfirst($this->argument('name'));

      $stub = str_replace(
          [
            'Parrotx\\\\Plugx\\\\',
            '"parrotx/plugx"',
            'Parrotx\Plugx\\',
            'pluginx/plugx',
            'parrotx-config',
            'plugxName',
            'pluginxJson',
            '\Parrotx\Plugx',
          ],
          [
            'Parrotx\\\\'.$Plugx.'\\\\',
            '"parrotx/'.$smallPlugx.'"',
            'Parrotx\\'.$Plugx.'\\',
            'pluginx/'.$smallPlugx,
            'parrotx_'.$smallPlugx,
            $smallPlugx.'x',
            $smallPlugx,
            '\parrotx\\'.$Plugx,
          ],
          $stub
      );


      return $stub;
  }


}



?>
