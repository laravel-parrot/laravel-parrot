<?php

namespace Parrot\Parrot\App\Http\Controllers\Core\Assets;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */

use Illuminate\Http\Request;
use Parrot\Parrot\App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class AssetsController extends Controller
{
    /**
     * construct call first and return void
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data($filename)
    {
       if (file_exists(parrot_path('bladex/'.$filename))) {
         $path = parrot_path('bladex/'.$filename);

         $file = File::get($path);
         $splitMime = explode(".",$filename);
         $takeMimePart = array_pop($splitMime);

         $mimes = new \Mimey\MimeTypes;
         $fileMime = $mimes->getMimeType($takeMimePart);

         $response = Response::make($file, 200);
         $response->header("Content-Type", $fileMime);

         return $response;
       }

        return dd('Something Wrong or Not found');

    }

    public function dataPkg($pkg,$filename){

      if (file_exists(pluginx_path($pkg.'/bladex//'.$filename))) {
        $path = pluginx_path($pkg.'/bladex//'.$filename);

        $file = File::get($path);
        $splitMime = explode(".",$filename);
        $takeMimePart = array_pop($splitMime);

        $mimes = new \Mimey\MimeTypes;
        $fileMime = $mimes->getMimeType($takeMimePart);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $fileMime);

        return $response;
      }

       return dd('Something Wrong or Not found');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
