<?php

namespace App\Helpers;

use Config;
use DB;

class DatabaseConnection {
    public static function setConnection($params) {
        if ($params->dbRadio === 'pgsql') {
            $dbname = 'postgres';
            config(['database.connections.onthefly' => [
                'driver' => $params->dbRadio,
                'host' => $params->host,
                'port' => $params->port,
                'database' => $dbname,
                'username' => $params->user,
                'password' => $params->password,
                'charset' => 'utf8',
                'prefix' => '',
            ]]);
        } else {
            $dbname = 'master';
            config(['database.connections.onthefly' => [
                'driver' => $params->dbRadio,
                'host' => $params->host,
                'port' => $params->port,
                'database' => $dbname,
                'username' => $params->user,
                'password' => $params->password,
                'charset' => 'utf8',
                'prefix' => '',
                'schema' => 'public',
                'sslmode' => 'prefer',
            ]]);
        } 
        
        return DB::connection('onthefly');
    }
}