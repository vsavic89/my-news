@extends('master')
@section('content')
<div class="alert alert-info text-center">
    <h1>List of tags</h1>
</div>
@if(count($tags) > 0)
    <table class="table display" style="width:100%">
        <thead>
            <tr>
                <th>
                    ID
                </th>
                <th>
                    Name
                </th>
                <th>
                    Created at
                </th>
            </tr>  
        </thead>
        <tbody>
        @foreach($tags as $tag)
            <tr>
                <td>{{ $tag->id }} </td>
                <td>{{ $tag->name }}</td>                
                <td>{{ $tag->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div class='alert alert-danger'>
        <h4>No tags to show!</h4>
    </div>
@endif
@endsection