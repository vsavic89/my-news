@extends('master')
@section('content')      
<div class="alert alert-info text-center">
    <h1>List of articles</h1>
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