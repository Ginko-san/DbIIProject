<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FileController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $data = DB::connection('onthefly')->select("SELECT FileGroup = FILEGROUP_NAME(a.data_space_id), 
                                                                    DatabaseName = DB_NAME(a.database_id), 
                                                                    a.name, a.physical_name as 'Filename', 
                                                                    8 * a.size AS 'size', 
                                                                    8 * a.max_size AS 'maxsize', 
                                                                    8 * a.growth AS 'growth' 
                                                FROM sys.master_files a 
                                                INNER JOIN sys.filegroups f 
                                                ON a.data_space_id = f.data_space_id 
                                                ORDER BY FILEGROUP_NAME(a.data_space_id)");

        return view('files.index',['filegroups'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $sysDataBases = DB::select('SELECT name FROM master.dbo.sysdatabases');
        $filegroups = DB::select('SELECT name from sys.filegroups');

        return view('files.create', ['filegroups'=>$filegroups, 'databases'=>$sysDataBases]);
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
          'Database'=>'required',
          'name'=>'required',
          'Filename'=>'required',
          'size'=>'required',
          'maxsize'=>'required',
          'growth'=>'required',
          ]);

        $alterQuery = "ALTER DATABASE ".$request->Database."
                       ADD FILE
                       (
                           NAME = '".$request->name."',
                           FILENAME = '/home/ginko-san/test/".$request->name.".".$request->Filename."',
                           SIZE = ".$request->size."MB,
                           MAXSIZE = ".$request->maxsize."MB,
                           FILEGROWTH = ".$request->growth."MB
                       )";

        $alterFilegroup = DB::connection('onthefly')->statement($alterQuery);
      
      return redirect()->route('file.index')->with('message','data has been updated!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  name $name   name of the current file to modify
     * @return Response
     */
    public function edit($name)
    {
        $selectQuery = "SELECT 
                                FileGroup = FILEGROUP_NAME(a.data_space_id), 
                                DatabaseName = DB_NAME(a.database_id), 
                                a.name,
                                a.physical_name as 'Filename', 
                                8 * a.size AS 'size', 
                                8 * a.max_size AS 'maxsize', 
                                8 * a.growth AS 'growth' 
                        FROM sys.master_files a 
                        INNER JOIN sys.filegroups f 
                        ON a.data_space_id = f.data_space_id 
                        WHERE a.name = '".$name."'
                        ORDER BY FILEGROUP_NAME(a.data_space_id)";
                        
        $filegroup = DB::connection('onthefly')->select($selectQuery);

      return view('files.edit',['filegroup'=>$filegroup]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  name $name   name of the current file to modify
     * @return Response
     */
    public function update(Request $request,$name)
    {
        $selectQuery = "SELECT 
                                FileGroup = FILEGROUP_NAME(a.data_space_id), 
                                DatabaseName = DB_NAME(a.database_id), 
                                a.name,
                                a.physical_name as 'Filename', 
                                8 * a.size AS 'size', 
                                8 * a.max_size AS 'maxsize', 
                                8 * a.growth AS 'growth' 
                        FROM sys.master_files a 
                        INNER JOIN sys.filegroups f 
                        ON a.data_space_id = f.data_space_id 
                        WHERE a.name = '".$name."'
                        ORDER BY FILEGROUP_NAME(a.data_space_id)";
                        
        $filegroup = DB::connection('onthefly')->select($selectQuery);

        if(!$filegroup){
             abort(404);
        }
        else{
            $alterQuery = "ALTER DATABASE ".$filegroup[0]->DatabaseName."
                           MODIFY FILE
                           (
                               NAME = '".$filegroup[0]->name."',
                               NEWNAME = '".$request->name."',
                               FILENAME ='".$filegroup[0]->Filename."',
                               SIZE = ".$request->size."KB,
                               MAXSIZE = ".$request->maxsize."KB,
                               FILEGROWTH = ".$request->growth."KB
                           )";

            $alterFilegroup = DB::connection('onthefly')->statement($alterQuery);

            return redirect()->route('file.index')->with('message','data has been updated!');
        }
    }
}
