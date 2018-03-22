<?php

namespace App\Helpers;

use Config;
use DB;

class DatabaseConnection {
    public static function setConnection($params) {
        $dbname = ($request->dbRadio === 'pgsql') ? 'pgsql' : 'sqlsrv';

        config(['database.connections.onthefly' => [
            'driver' => $params->driver,
            'host' => $params->host,
            'port' => $request->port,
            'database' => $dbname,
            'username' => $params->username,
            'password' => $params->password,
            'charset' => 'utf8',
            'prefix' => '',
        ]]);

        return DB::connection('onthefly');
    }
}