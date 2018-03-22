<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Config;
use DB;

class DatabaseConnection {
    public static function setConnection(Request $params) {
        $dbname = ($request->dbRadio === 'pgsql') ? 'postgres' : 'master';

        config(['database.connections.onthefly' => [
            'driver' => $params->dbRadio,
            'host' => $params->host,
            'port' => $request->port,
            'database' => $dbname,
            'username' => $params->user,
            'password' => $params->password,
            'charset' => 'utf8',
            'prefix' => '',
        ]]);

        return DB::connection('onthefly');
    }
}