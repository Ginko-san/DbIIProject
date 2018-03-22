<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\DatabaseConnection;
use DB;

class LoginController extends Controller
{
    //
    private $isConnected = False;

    public function index() {
        return view('auth.login');
    }

    public function store(Request $request) {
        $this->validate($request,[
            'user'=>'required',
            'password'=>'required',
            'host'=>'required',
            'port'=>'required',
            'dbRadio'=>'required',
        ]);

        $connection = DatabaseConnection::setConnection($request);

        $result = $connection->logging();
        
        if ($result)
            return redirect()->route('dashboard.index',['connection'=>$connection])->with('message','Connection Ready!');
        else
            return redirect()->route('login.index')->with('message','Something went wrong dude!');
    }
}
