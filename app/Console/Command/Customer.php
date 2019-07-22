<?php

namespace Parrot\Parrot\App\Console\Command;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */

use Illuminate\Console\Command;
use Symfony\Finder\Finder;

class Customer extends Command
{
  protected $signature = 'ct:name';
  protected $description = 'this is testing';
  public function handle(){
    $this->info('customer here');

  }

  public function load(){
    // $r = new Finder;
    //
    // $p = $r->path(base_path('config'))->files();
    // return $p;
  }
}
 ?>
