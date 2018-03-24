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
        $data = DB::connection('onthefly')->select("SELECT name from sys.filegroups");

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
        $currentDatabase = config('database.connections.onthefly.database');
        
      $this->validate($request,[
          'FileGroup'=>'required',
          ]);

        $alterQuery = "ALTER DATABASE ".$currentDatabase."
                       ADD FILEGROUP ".$request->FileGroup.";";

        $alterFilegroup = DB::connection('onthefly')->statement($alterQuery);
      
      return redirect()->route('filegroup.index')->with('message','data has been updated!');
    }
}
