<?php

namespace Parrot\Parrot\App\Console\Command;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */

use Illuminate\Console\Command;
use Symfony\Finder\Finder;
use Parrot\Parrot\Core\Files\Filesystem as ParrotFile;
use Illuminate\Support\Str;

class User extends Command
{
  protected $signature = 'ar:tr {me}';
  protected $description = 'this is testing';


  public function handle(){
    $this->info($this->argument('me'));
    $this->makeFileThere($this->argument('me'));

  }
  public function makeFileThere($val){
    $filer = new ParrotFile;
    //$filer->makeDirectory(base_path('hr'));


    $this->info($filer->exists(base_path('mk')));



    if ($filer->exists(base_path('hr/'.ucfirst($this->argument('me')).'.php'))) {
      $this->info('alreadyExists');

    } else {
      $filer->put(base_path('hr/'.ucfirst($this->argument('me')).'.php'),'kamal is here hm');
    }
    $abir = $filer->get(base_path('hr/'.ucfirst($this->argument('me')).'.php'));
    str_replace('Dummy','mostafa', $abir);
  }

}



 ?>
