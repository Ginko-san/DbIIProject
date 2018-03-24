@extends('layouts.app')
@include('menu')
@section('content')
<br/>
<div class="row center alert alert-danger col-md-4" role="alert">
    U Can't add files for db Master or Model. Avoid select them in the "Database List"
</div>
<br/>
<div class="container">
    <div class="row">
        <form class="form-horizontal col-md-5 center" role="form" action="{{route('file.store')}}" method="POST">
            <div class="form-group">
                <label for="FileGroup"><span data-feather="layers"></span>  FileGroup List: </label>
                <select class="form-control custom-select" id="FileGroup" name="FileGroup">
                    @foreach($filegroups as $fg)
                        @if ($fg->name != "master") 
                            @if ($fg->name != "model")
                                <option value="{{ $fg->name }}">{{ $fg->name }}</option> 
                            @endif
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="Database"><span data-feather="layers"></span>  Database List: </label>
                <select class="form-control custom-select" id="Database" name="Database">
                    @foreach($databases as $db)
                    <option value="{{ $db->name }}">{{ $db->name }}</option> 
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">File Name</label>
                <input type="text" class="form-control" id="name" name="name" value="">
            </div>
            <div class="form-group">
                <label for="Filename">File Path</label>
                <input type="text" class="form-control" value="/home/ginko-san/test/ + File Name + .mdf/ndf" disabled>
                <select class="form-control custom-select" id="Filename" name="Filename">
                    <option value="mdf">mdf</option>
                    <option value="ndf">ndf</option>
                </select>
            </div>
            <div class="form-group">
                <label for="size">Size MB</label>
                <input type="number" class="form-control" id="size" name="size" placeholder="# in MB"></input>
            </div>
            <div class="form-group">
                <label for="maxsize">Max Size MB</label>
                <input type="number" class="form-control" id="maxsize" name="maxsize" placeholder="# in MB"></input>
            </div>
            <div class="form-group">
                <label for="growth">Growth MB</label>
                <input type="number" class="form-control" id="growth" name="growth" placeholder="# in MB"></input>
            </div>
            <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input class="btn btn-dark btn-block" type="submit" value="Create File">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection