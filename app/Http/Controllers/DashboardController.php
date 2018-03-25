<?php

namespace App\Http\Controllers;

use App\Helpers\DatabaseConnection;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    //
    public function index() {
        $value = config('database.connections.onthefly.driver');
        
        $DBreturned = DB::connection('onthefly')->getDatabaseName();
        
        if ($value === 'sqlsrv') {
            $sysDataBases = $this->runASelectQuery('SELECT name FROM master.dbo.sysdatabases');
            return view('dashboard', ['databasesOnList' => $sysDataBases, 'currentDB' => $DBreturned]);
        } else if ($value === 'pgsql') {
            $sysDataBases = $this->runASelectQuery('SELECT datname as name FROM pg_database;');
            $dbDataPlus = $this->runASelectQuery('SELECT datname, pg_size_pretty(pg_database_size(datname))
                                                  FROM pg_database
                                                  ORDER BY pg_database_size(datname) desc;');
            return view('dashboard', ['databasesOnList' => $sysDataBases, 'currentDB' => $DBreturned, 'dbData'=>$dbDataPlus]);
        }
        
        

        
    }

    public function logout() {
        DB::disconnect();
        return view('auth.login', ['message' => '']);
    }

    public static function screenMonitorDataReturn() {
        $value = config('database.connections.onthefly.driver');

        if ($value === 'sqlsrv') {
            $data = DB::connection('onthefly')->select('SELECT sum(sf.growth) growth,sum(SF.maxsize) maxsize,sum(U.total_page_count) actualSize,sum(u.allocated_extent_page_count) usedSize, sum(u.unallocated_extent_page_count) unusedSize from sysfiles sf inner join sys.dm_db_file_space_usage U on sf.fileid=u.file_id;');
            return $data;
        } else if ($value === 'pgsql') {
            $data = DB::connection('onthefly')->select('SELECT datname FROM pg_database');
            return $data;
        }
    }

    public function changeDatabaseNameConnected(Request $request) {
        $this->validate($request,[
            'databases'=>'required',
            ]);
        
        DatabaseConnection::modEnvDBName($request->databases);
        sleep(1);
        
        try {
            $data = DatabaseConnection::setDBName($request);
        } catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration. Error: ".$e->getMessage());
        }

        return redirect()->route('dashboard.index')->with('message','db has been changed!');
    }

    private function runASelectQuery($queryToRun) {
        return DB::select($queryToRun);
    }
}
