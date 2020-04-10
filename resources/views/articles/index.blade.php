@extends('master')
@section('content')      
<div class="alert alert-info text-center">
    <h1>List of articles</h1>
</div>
    @if(count($articles) > 0)
        <table id="tbl" class='display' width="100%">
            @foreach($articles as $article)                            
                
            @endforeach    
        </table>
    @else
        <div class='alert alert-danger'>
            <h3>
                No articles to show!
            </h3>
        </div>
    @endif
@endsection