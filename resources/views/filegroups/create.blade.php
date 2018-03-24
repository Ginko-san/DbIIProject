@extends('layouts.app')
@include('menu')
@section('content')
<br/>
<br/>
<div class="container">
    <div class="row">
        <form class="form-horizontal col-md-5 center" role="form" action="{{route('filegroup.store')}}" method="POST">
            <div class="form-group">
                <label for="FileGroup">FileGroup Name</label>
                <input type="text" class="form-control" id="FileGroup" name="FileGroup" placeholder="Name for FileGroup">
            </div>
            <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input class="btn btn-dark btn-block" type="submit" value="Create Filegroup">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection