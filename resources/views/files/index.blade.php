@extends('layouts.app')
@include('menu')
@section('content')
<br/>
<br/>
<div class="container">
    <div class="row">
        <div class="panel-body">
            <a href="{{ route('file.create') }}" class="btn btn-dark" role="button">New File</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>FileGroup</th>
                        <th>Database</th>
                        <th>File Name</th>
                        <th>File Path</th>
                        <th>Size KB</th>
                        <th>Max Size KB</th>
                        <th>Growth KB</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($filegroups as $fgRow)
                        <tr>
                            <th scope="row">{{ $fgRow->FileGroup }}</th>
                            <th>{{ $fgRow->DatabaseName }}</th>
                            <th>{{ $fgRow->name }}</th>
                            <th>{{ $fgRow->Filename }}</th>
                            <th>{{ $fgRow->size }}</th>
                            @if ($fgRow->maxsize < 0)
                                <th> ∞ </th>
                            @else
                                <th>{{ $fgRow->maxsize }}</th>
                            @endif
                            <th>{{ $fgRow->growth }}</th>
                            <th>
                                <p>
                                <a href="{{route('file.index')}}/{{$fgRow->name}}/edit" class="btn btn-dark" role="button">Modify</a>
                                </p>
                                </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection