@extends('master')
@include('_button-action-delete')
@include('_button-action-edit')
@section('content')      
<div class="alert alert-info text-center">
    <h1>List of articles</h1>    
    <h3><span class="badge"><a href="/articles/create" class="btn btn-primary font-weight-bold">Create New Article</a></span></h3>
</div>
    @if(count($articles) > 0)
        <table class='table display' width="100%">                                  
            <thead>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Title
                    </th>
                    <th>
                        Body
                    </th>
                    <th>
                        Tags
                    </th>
                    <th>
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)      
                <tr>
                    <td>
                        {{ $article->id }}
                    </td>
                    <td>
                        {{ $article->title }}
                    </td>
                    <td>
                        {{ $article->body }}
                    </td> 
                    <td>
                        @foreach($article->tags as $tag)
                            @if($loop->last)
                                {{ $tag->name }}
                            @else
                                {{ $tag->name . ', ' }}
                            @endif
                        @endforeach
                    </td>
                    <td class="text-center btn-primary">
                        <div class='row'>
                            <div class='col-5'>
                                <form action='/api/articles/edit/{{ $article->id }}' method='GET'>                            
                                    @csrf
                                    @yield('action-button-edit')
                                </form>                        
                            </div>
                            <div class='col-5'>                            
                                <form action="/api/articles/delete/{{ $article->id }}" method="POST">
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
            <h3>
                No articles to show!
            </h3>
        </div>
    @endif
@endsection