<?php

namespace Parrot\Parrot\Core\Consolex\Command;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */

use Parrot\Parrot\Core\Consolex\GeneratorJsnCommand;

class JsonSetupCommand extends GeneratorJsnCommand
{
  protected $signature = 'p-set:json';
  protected $description = 'main package json setup with merge';

  protected function getStub(){
    return __DIR__.'/../stubs/jsn.stub';
  }
  protected function getExtra(){
    $parrotExtra = '
    "merge-plugin": {
      "include": [
          "parrot/composer.json",
          "pluginx/*/composer.json"
          ],
      "require": [
        "parrot/composer.json",
        "pluginx/*/composer.json"
      ],
      "recurse": true,
      "replace": false,
      "ignore-duplicates": false,
      "merge-dev": true,
      "merge-extra": false,
      "merge-extra-deep": false,
      "merge-scripts": false
    }
    ';
    return $parrotExtra;
  }
}



 ?>
