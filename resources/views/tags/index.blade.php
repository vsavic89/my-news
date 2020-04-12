@extends('master')
@include('_button-action-edit')
@include('_button-action-delete')
@section('content')
<div class="alert alert-info text-center">
    <h1>List of tags</h1>
    <h3><span class="badge"><a href="/tags/create" class="btn btn-primary font-weight-bold">Create New Tag</a></span></h3>
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
                <th>
                    Actions
                </th>
            </tr>  
        </thead>
        <tbody>
        @foreach($tags as $tag)
            <tr>
                <td>{{ $tag->id }} </td>
                <td>{{ $tag->name }}</td>                
                <td>{{ $tag->created_at }}</td>
                <td class="text-center btn-primary">
                    <div class='row justify-content-center'>
                        <div class='col-3'>
                            <form action='/api/tags/edit/{{ $tag->id }}' method='GET'>                            
                                @csrf
                                @yield('action-button-edit')
                            </form>                        
                        </div>
                        <div class='col-3'>                            
                            <form action="/api/tags/delete/{{ $tag->id }}" method="POST">
                                @csrf
                                @yield('action-button-delete')                                
                            </form>
                        </div>
                </td>
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