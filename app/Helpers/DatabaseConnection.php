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
                'username' => $params->username,
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
                'username' => $params->username,
                'password' => $params->password,
                'charset' => 'utf8',
                'prefix' => '',
                'schema' => 'public',
                'sslmode' => 'prefer',
            ]]);
        } 
        
        return DB::connection('onthefly');
    }

    public static function setDBName($params) {
        config(['database.connections.onthefly.database' => $params->databases,]);
        return DB::connection('onthefly')->setDatabaseName($params->databases);
    }

    public static function modEnv($dbRadio, $host, $port, $username, $password) {
        $db = ($dbRadio == 'pgsql') ? 'postgres': 'master';
        $path = base_path('config/database.php');
        if (file_exists($path)) {

            // modify line 36 of the file config/database.php
            $parsed = self::get_string_between(file_get_contents($path), "'driver' => '", "',");
            file_put_contents($path, str_replace(
                "'driver' => '".$parsed,"'driver' => '".$dbRadio . "",file_get_contents($path)
            ));

            // modify line 37 of the file config/database.php
            $parsed = self::get_string_between(file_get_contents($path), "'host' => '", "',");
            file_put_contents($path, str_replace(
                "'host' => '".$parsed,"'host' => '".$host . "",file_get_contents($path)
            ));

            // modify line 38 of the file config/database.php
            $parsed = self::get_string_between(file_get_contents($path), "'port' => '", "',");
            file_put_contents($path, str_replace(
                "'port' => '".$parsed,"'port' => '".$port . "",file_get_contents($path)
            ));

            // modify line 39 of the file config/database.php
            $parsed = self::get_string_between(file_get_contents($path), "'database' => '", "',");
            file_put_contents($path, str_replace(
                "'database' => '".$parsed,"'database' => '".$db . "",file_get_contents($path)
            ));

            // modify line 40 of the file config/database.php
            $parsed = self::get_string_between(file_get_contents($path), "'username' => '", "',");
            file_put_contents($path, str_replace(
                "'username' => '".$parsed,"'username' => '".$username . "",file_get_contents($path)
            ));
            
            // modify line 41 of the file config/database.php
            $parsed = self::get_string_between(file_get_contents($path), "'password' => '", "',");
            file_put_contents($path, str_replace(
                "'password' => '".$parsed,"'password' => '".$password . "",file_get_contents($path)
            ));
        }
    }

    public static function modEnvDBName($dbName) {
        $path = base_path('config/database.php');
        if (file_exists($path)) {
            
            // modify line 39 of the file config/database.php
            $parsed = self::get_string_between(file_get_contents($path), "'database' => '", "',");
            file_put_contents($path, str_replace(
                "'database' => '".$parsed,"'database' => '".$dbName . "",file_get_contents($path)
            ));
        }
    }
    
    public static function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
}