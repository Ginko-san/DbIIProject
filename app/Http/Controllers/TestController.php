<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TestController extends Controller
{
    //
    public static function index() {
        $data = DB::connection('sqlsrv')->select('SELECT SF.name,sf.filename, sf.growth,SF.maxsize,U.total_page_count actualSize,u.allocated_extent_page_count usedSize, u.unallocated_extent_page_count unusedSize
        from sysfiles sf inner join sys.dm_db_file_space_usage U on sf.fileid=u.file_id');
        return $data;
    }
}
