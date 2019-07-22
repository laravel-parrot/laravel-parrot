<?php

namespace Parrot\Parrot\App\Http\Controllers\Core\Pluginx;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */

use Illuminate\Http\Request;
use Parrot\Parrot\App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Symfony\Component\Finder\Finder;

class PluginxController extends Controller
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
     * Display all pluginx.
     *
     * @return json | default
     */
    public function index()
    {
      $pluginx = [
        "count" => 0,
        "pluginx" =>[]
      ];

      if (file_exists(pluginx_path())) {
        foreach ((new Finder)->in(pluginx_path())->directories()->depth(0) as  $value){
          $directories = $value->getFilename();
          $pluginx['count'] += 1;
          $jsonDecode = json_decode(file_get_contents(pluginx_path($directories.'/pluginx.json')));
          array_push($pluginx['pluginx'],$jsonDecode);
        }
      }

      return response()->json($pluginx);

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
