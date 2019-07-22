<?php

use Illuminate\Contracts\Routing\UrlGenerator;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */

if (! function_exists('parrot_path'))  {

  function parrot_path($path = ''){
    $add_path = $path ? DIRECTORY_SEPARATOR.$path : $path;
    return base_path('parrot'.$add_path);
  }

}

if (! function_exists('pluginx_path'))  {

  function pluginx_path($path = ''){
    $add_path = $path ? DIRECTORY_SEPARATOR.$path : $path;
    return base_path('pluginx'.$add_path);
  }

}

if (! function_exists('assetx')) {
  function assetx($path = ''){
    return app('url')->asset("assetx/".$path,null);
    //return app('url')->asset('parrot/cdn/'.$path,null);
  }
}

if (! function_exists('asset2x')) {
  function asset2x($pluginx = '', $path = ''){
    return app('url')->asset("asset2x/".$pluginx."/".$path,null);
    //return app('url')->asset('parrot/cdn/'.$path,null);
  }
}
