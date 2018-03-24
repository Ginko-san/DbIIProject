@extends('layouts.app')
@include('menu')
@section('content')
<br/>
<br/>
<div class="container">
    <div class="row">
        <form class="form-horizontal col-md-5 center" role="form" action="{{route('file.index')}}/{{ $filegroup[0]->name }}" method="POST">
            <div class="form-group">
                <label for="FileGroup">FileGroup</label>
                <input type="text" class="form-control" id="FileGroup" name="FileGroup" value="{{ $filegroup[0]->FileGroup }}" disabled>
            </div>
            <div class="form-group">
                <label for="Database">Database</label>
                <input type="text" class="form-control" id="Database" name="Database" value="{{ $filegroup[0]->DatabaseName }}" disabled>
            </div>
            <div class="form-group">
                <label for="name">File Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $filegroup[0]->name }}">
            </div>
            <div class="form-group">
                <label for="Filename">File Path</label>
                <input type="text" class="form-control" id="Filename" name="Filename" value="{{ $filegroup[0]->Filename }}" disabled>
            </div>
            <div class="form-group">
                <label for="size">Size KB</label>
                <input type="number" class="form-control" id="size" name="size" placeholder="#" value="{{ $filegroup[0]->size }}"></input>
            </div>
            <div class="form-group">
                <label for="maxsize">Max Size KB</label>
                <input type="number" class="form-control" id="maxsize" name="maxsize" placeholder="#" value="{{ $filegroup[0]->maxsize }}"></input>
            </div>
            <div class="form-group">
                <label for="growth">Growth KB</label>
                <input type="number" class="form-control" id="growth" name="growth" placeholder="#" value="{{ $filegroup[0]->growth }}"></input>
            </div>
            <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                    <input class="btn btn-dark btn-block" type="submit" value="Modify">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection