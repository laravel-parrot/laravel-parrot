<?php

namespace Parrot\Parrot\Core\Consolex\Command;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */

use Illuminate\Console\Command;
use Symfony\Component\Finder\Finder;

class RenameMigrationFiles extends Command
{
  protected $signature = 'p-rename:mg {--pkg=} {--all=}';
  protected $description = 'rename all migrations files';

  public function handle(){

    $desiredPath = '';
    if (!empty($this->option('pkg'))) {
      if(file_exists(base_path('pluginx/').$this->option('pkg'))){
        $desiredPath = 'pluginx/'.$this->option('pkg');
      } else {
        $desiredPath = 'parrot';
      }

    } else {
      $desiredPath = 'parrot';
    }

    foreach ((new Finder)->in(base_path($desiredPath.'/database/migrations'))->files() as  $value) {

      $realFileName = $value->getFilename();
      $datePart = substr($realFileName,0,10);
      $fileName = substr($realFileName,10);
      $renamer = date('Y_m_d').$fileName;
      rename(base_path($desiredPath.'/database/migrations/'.$realFileName),base_path($desiredPath.'/database/migrations/'.$renamer));

    }


    if (!empty($this->option('all'))) {
      // all pluginx database migrations files
      foreach ((new Finder)->in(pluginx_path())->directories()->depth(0) as  $value){
        $directories = $value->getFilename();
        foreach ((new Finder)->in(pluginx_path($directories.'/database/migrations'))->files() as  $value) {
          $realFileName = $value->getFilename();
          $datePart = substr($realFileName,0,10);
          $fileName = substr($realFileName,10);
          $renamer = date('Y_m_d').$fileName;
          rename(pluginx_path($directories.'/database/migrations/'.$realFileName),pluginx_path($directories.'/database/migrations/'.$renamer));
        }
      }
      // laravel core database migrations file
      foreach ((new Finder)->in(base_path('database/migrations'))->files() as  $value) {
        $realFileName = $value->getFilename();
        $datePart = substr($realFileName,0,10);
        $fileName = substr($realFileName,10);
        $renamer = date('Y_m_d').$fileName;
        rename(base_path('database/migrations/'.$realFileName),base_path('database/migrations/'.$renamer));
      }
    }

    $this->info("done !! rename !! Migration files ");


  }

}



?>
