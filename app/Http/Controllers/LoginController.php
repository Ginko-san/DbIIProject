<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

use Illuminate\Http\Request;
use DB;
use Config;

class LoginController extends Controller
{
    //
    private $isConnected = False;
    private $userReq = '';
    private $passwordReq = '';
    private $hostReq = '';
    private $portReq = '';
    private $dbRadioReq = '';
    private $nameReq = '';

    public function index() {
        return view('auth.login');
    }

    public function store(Request $request) {
        $this->validate($request,[
            'user'=>'required',
            'password'=>'required',
            'host'=>'required',
            'port'=>'required',
        ]);
        
        $this->userReq = $request->user;
        $this->passwordReq = $request->password;
        $this->hostReq = $request->host;
        $this->portReq = $request->port;
        $this->dbRadioReq = $request->dbRadio;
        $this->nameReq = ($request->dbRadio === 'pgsql') ? 'postgres' : 'master';
        
        $this->modEnv();

        try {
            DB::connection('custom')->getPdo();
        } catch (Exception $e) {
            die("Could not connect to the database.  Please check your configuration.");
            return redirect()->route('login.index')->with('message','Something went wrong dude!');
        }

        return redirect()->route('dashboard.index')->with('message','Connection Ready!');

    }

    private function modEnv() {
        $path = base_path('config/database.php');
        if (file_exists($path)) {

            // modify line 36 of the file config/database.php
            $parsed = $this->get_string_between(file_get_contents($path), "'driver' => '", "',");
            file_put_contents($path, str_replace(
                "'driver' => '".$parsed,"'driver' => '".$this->dbRadioReq . "",file_get_contents($path)
            ));

            // modify line 37 of the file config/database.php
            $parsed = $this->get_string_between(file_get_contents($path), "'host' => env('DB_HOST', '", "'),");
            file_put_contents($path, str_replace(
                "'host' => env('DB_HOST', '".$parsed,"'host' => env('DB_HOST', '".$this->hostReq . "",file_get_contents($path)
            ));

            // modify line 38 of the file config/database.php
            $parsed = $this->get_string_between(file_get_contents($path), "'port' => env('DB_PORT', '", "'),");
            file_put_contents($path, str_replace(
                "'port' => env('DB_PORT', '".$parsed,"'port' => env('DB_PORT', '".$this->portReq . "",file_get_contents($path)
            ));

            // modify line 39 of the file config/database.php
            $parsed = $this->get_string_between(file_get_contents($path), "'database' => env('DB_DATABASE', '", "'),");
            file_put_contents($path, str_replace(
                "'database' => env('DB_DATABASE', '".$parsed,"'database' => env('DB_DATABASE', '".$this->nameReq . "",file_get_contents($path)
            ));

            // modify line 40 of the file config/database.php
            $parsed = $this->get_string_between(file_get_contents($path), "'username' => env('DB_USERNAME', '", "'),");
            file_put_contents($path, str_replace(
                "'username' => env('DB_USERNAME', '".$parsed,"'username' => env('DB_USERNAME', '".$this->userReq . "",file_get_contents($path)
            ));
            
            // modify line 41 of the file config/database.php
            $parsed = $this->get_string_between(file_get_contents($path), "'password' => env('DB_PASSWORD', '", "'),");
            file_put_contents($path, str_replace(
                "'password' => env('DB_PASSWORD', '".$parsed,"'password' => env('DB_PASSWORD', '".$this->passwordReq . "",file_get_contents($path)
            ));
        }
    }

    private function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
}
