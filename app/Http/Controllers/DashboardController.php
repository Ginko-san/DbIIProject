<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    //
    public function index() {

        return view('dashboard');
    }

    public static function screenMonitorDataReturn() {
        $value = config('database.connections.custom.driver');

        if ($value === 'sqlsrv') {
            $data = DB::connection('custom')->select('SELECT * from sysfiles;');
            DB::disconnect();

            return $data;
        }
        else if ($value === 'pgsql') {
            $data = DB::connection('custom')->select('SELECT datname FROM pg_database');
            DB::disconnect();
            //$data = DB::connection('custom')->select('SELECT SF.name,sf.filename, sf.growth,SF.maxsize,U.total_page_count actualSize,u.allocated_extent_page_count usedSize, u.unallocated_extent_page_count unusedSize from sysfiles sf inner join sys.dm_db_file_space_usage U on sf.fileid=u.file_id')->disconnect();
            return $data;
        }
    }
}
