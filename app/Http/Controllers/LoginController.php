<?php

namespace App\Http\Controllers;

use App\Helpers\DatabaseConnection;

use Illuminate\Http\Request;
use Config;
use DB;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login', ['message' => '']);
    }

    public function store(Request $request) {
        $this->validate($request,[
            'username'=>'required',
            'password'=>'required',
            'host'=>'required',
            'port'=>'required',
        ]);

        try {
            $conn = DatabaseConnection::setConnection($request);
            //$conn = DB::connection('onthefly');
            $pdo = $conn->getPdo();
        } catch (\Exception $e) {
            //die("Could not connect to the database.  Please check your configuration. Error: ".$e->getMessage());
            return view('auth.login', ['message' => 'Something went wrong dude, pls try again!']);
        }
        
        DatabaseConnection::modEnv($request->dbRadio, $request->host, $request->port, $request->username, $request->password);
        sleep(1);
        return redirect()->route('dashboard.index', ['connection'=>$conn])->with('message','Connection Ready!');

    }
}
