@extends('master')
@section('content')
    @if(!empty($model))
        <h1 class='alert alert-info text-center'>
            Edit the Article<small>&nbsp;&nbsp;oldish article info</small>   
        </h1>
    @else
    <h1 class='alert alert-info text-center'>
        Create New Article<small>&nbsp;&nbsp;fresh article info</small>
    </h1>
    @endif
    <p class='lead'>Lorem ipsum... <button class='btn btn-info' disabled='disabled'>Disabled</button></p>
    <p>Lorem ipsum...rogjoiwrej <mark>gerwiogj</mark> iroejg oierjg <span class='text-primary'>ieorjg</span> ioerjg oierj oierj ioerj </p>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting <strong>industry</strong>. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>    
    @if(!empty($model))
        <form method="POST" action="/api/articles/edit/{{ $model->id }}">            
    @else
        <form method="POST" action="/api/articles">
    @endif
        @csrf           
        <div class="form-group border">
            <div class='row m-2 justify-content-center'>
                <div class="col-2">
                    <label for="title">Title: </label>
                </div>
                <div class="col-4">
                    <input class="form-control" name="title"  value='{{ empty($model) ? '' : $model->title }}'/>
                </div>        
            </div>
            <div class='row m-2 justify-content-center'>
                <div class="col-2">
                    <label for="body">Body: </label>
                </div>
                <div class="col-4">
                    <textarea rows='5' class='form-control' name='body' >{{ empty($model) ? '' : $model->body }}</textarea>                    
                </div>
            </div>           
            <div class='row m-2 justify-content-center'>
                <div class="col-2">
                    <label for="author_id">Author: </label>
                </div>
                <div class="col-4">
                    <select class="form-control" id="author" name='author_id'>
                        <option value='' selected='selected' ></option>
                        @foreach($authors as $author)                            
                            <option value="{{ $author->id }}" 
                                    @if(!empty($model) && ($model->author_id == $author->id))
                                        selected="selected"
                                    @endif
                                    >
                                {{ $author->full_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>     
            <div class='row m-2 justify-content-center'>
                <div class="col-2">
                    <label for="tags">Tags: </label>                    
                </div>                
                <div class="col-4">                    
                    <select multiple class="form-control" name='tags[]'>                        
                        @foreach($tags as $tag)                            
                            <option value="{{ $tag->id }}"                                     
                                    @if(!empty($model))          
                                        @foreach($model->tags as $tagM)
                                           @if($tagM->id == $tag->id))                                             
                                             selected="selected"
                                            @endif 
                                         @endforeach                                         
                                    @endif
                                    >
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>    
            <div class='row m-2 justify-content-center'>
                <div class='col-6'>
                    <button class='mt-2 btn btn-primary btn-block' type="submit">Send</button>
                </div>        
            </div>   
        </div>   
    </form>
@endsection
@include('_error_handler')