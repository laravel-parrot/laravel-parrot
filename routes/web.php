<?php

/*
|--------------------------------------------------------------------------
| Web Routes Parrot
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your parrot application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('parrot',function(){
  return view('parrot::welcome');

  //return File::get(parrot_path('bladex/text.html'));


});

Route::get('/pluginx', 'Core\Pluginx\PluginxController@index');
