@extends('layouts.app')

@section('content')
<style>
    body {
	    background: #343a40;
	    color: #343a40;
    }
</style>

<div class="container signIn-label animated fadeInDownBig login">
    <div class="row">
        <label class="center fellFont" ><h1>Databases Admin</h1></label>
    </div>
    <div class="row">
        <div class="card center text-center text-black bg-white col-md-4">
            <div class="card-header">Sign in</div>
            <div class="card-body">
                <form class="" role="form" method="POST" action="{{ route('login.store') }}">
                    {{ csrf_field() }}

                    <div class="form-group row">
                        <label for="username" class="control-label">Username</label>
                        <input id="username" type="text" class="form-control" name="username" placeholder="SuperAdmin" required autofocus>
                    </div>
                
                    <div class="form-group row">
                        <label for="password" class="control-label">Password</label>
                        <input id="password" type="password" class="form-control" name="password" placeholder="******" required>
                    </div>

                    <div class="form-group row">
                        <label for="host" class="control-label">Host</label>
                        <input id="host" type="text" class="form-control" name="host" placeholder="Ex. localhost" required>
                    </div>
                    
                    <div class="form-group row">
                        <label for="port" class="control-label">Port</label>
                        <input id="port" type="text" class="form-control" name="port" placeholder="Ex. 1433" required>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="dbRadio" id="pgsqlRadio" value="pgsql" checked>
                        <label class="form-check-label" for="pgsqlRadio">
                            Postgresql
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="dbRadio" id="mssqlRadio" value="sqlsrv" >
                        <label class="form-check-label" for="mssqlRadio">
                            SQL Server
                        </label>
                    </div>

                    <div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input class="btn btn-dark btn-block" type="submit"  value="Connect">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if ($message !== '')
        <div class="row center alert alert-danger col-md-4" role="alert">
            {{ $message }}
        </div>
    @endif
</div>
@endsection