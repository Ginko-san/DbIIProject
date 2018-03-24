@extends('layouts.app')
@include('menu')
@section('content')
<br/>
<br/>
<div class="container">
    <div class="row ">
        <div class="panel-body col-md-3 center">
            <a href="{{ route('filegroup.create') }}" class="btn btn-dark" role="button">New File</a>
            <br/>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>FileGroup</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($filegroups as $fgRow)
                        <tr>
                            <th scope="row">{{ $fgRow->name }}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection