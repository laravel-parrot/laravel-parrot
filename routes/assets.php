<?php

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */

/**
 * Parrot Asset Routes
 * <bladex>
 * assetx('file') and asset2x('plugName','file')
 */

Route::get('/assetx/{params}', 'Core\Assets\AssetsController@data')->where('params', '.*');
Route::get('/asset2x/{pkg}/{filename}', 'Core\Assets\AssetsController@dataPkg')->where('filename', '.*');
