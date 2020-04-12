@extends('master')
@include('_button-action-delete')
@include('_button-action-edit')
@section('content')
<div class="alert alert-info text-center">
    <h1>List of authors</h1>
    <h3><span class="badge"><a href="/authors/create" class="btn btn-primary font-weight-bold">Create New Author</a></span></h3>
</div>
@if(count($authors) > 0)
    <table class="table display" id="authors" style="width:100%">
        <thead>
            <tr>
                <th>
                    ID
                </th>
                <th>
                    Full Name
                </th>
                <th>
                    City
                </th>
                <th class="text-center">
                    Actions
                </th>
            </tr>  
        </thead>
        <tbody>        
        @foreach($authors as $author)
            <tr>
                <td>{{ $author->id }}</td>
                <td>{{ $author->full_name }}</td>
                <td>{{ $author->city }}</td>
                <td class="text-center btn-primary">
                    <div class='row justify-content-center'>
                        <div class='col-3'>
                            <form action='/api/authors/edit/{{ $author->id }}' method='GET'>                            
                                @csrf
                                @yield('action-button-edit')
                            </form>                        
                        </div>
                        <div class='col-3'>                            
                            <form action="/api/authors/delete/{{ $author->id }}" method="POST">
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
        <h4>No authors to show!</h4>
    </div>
@endif
@endsection