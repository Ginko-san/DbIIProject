<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FileGroupController extends Controller
{
    //
    //
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index() {
        $value = config('database.connections.onthefly.driver');

        if ($value === 'sqlsrv') {
            $data = DB::connection('onthefly')->select("SELECT name from sys.filegroups");
        } else if ($value === 'pgsql') {
            $data = DB::connection('onthefly')->select('SELECT spcname as name FROM pg_tablespace;');
        }

        return view('filegroups.index',['filegroups'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('filegroups.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)//crea un nuevo cliente
    {
        $this->validate($request,[
            'FileGroup'=>'required',
        ]);
            
        $value = config('database.connections.onthefly.driver');
        $currentDatabase = config('database.connections.onthefly.database');


        if ($value === 'sqlsrv') {
            $alterQuery = "ALTER DATABASE ".$currentDatabase."
                       ADD FILEGROUP ".$request->FileGroup.";";
        } else if ($value === 'pgsql') {
            //$this->mkdirAndChown('/home/ginko-san/testpg/', $request->FileGroup);
            $alterQuery = "CREATE TABLESPACE ".$request->FileGroup." LOCATION '/home/ginko-san/testpg2/".$request->FileGroup."';";
        }

        $alterFilegroup = DB::connection('onthefly')->statement($alterQuery);
      
      return redirect()->route('filegroup.index')->with('message','data has been updated!');
    }

    private function mkdirAndChown($basePath, $filename){
        $path = $basePath.$filename;
        mkdir($path, 0700, true);

        // Set the user
        chown($path, 'postgres');
        
    }
}
