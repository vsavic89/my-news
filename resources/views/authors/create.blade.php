@extends('master')
@section('content')
    @if(!empty($model))
        <h1 class='alert alert-info text-center'>
            Edit the Author<small>&nbsp;&nbsp;oldish article creator</small>   
        </h1>
    @else
    <h1 class='alert alert-info text-center'>
        Create New Author<small>&nbsp;&nbsp;fresh article creator</small>
    </h1>
    @endif
    <p class='lead'>Lorem ipsum... <button class='btn btn-info' disabled='disabled'>Disabled</button></p>
    <p>Lorem ipsum...rogjoiwrej <mark>gerwiogj</mark> iroejg oierjg <span class='text-primary'>ieorjg</span> ioerjg oierj oierj ioerj </p>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting <strong>industry</strong>. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>    
    @if(!empty($model))
        <form method="POST" action="/api/authors/edit/{{ $model->id }}">            
    @else
        <form method="POST" action="/api/authors">
    @endif
        @csrf           
        <div class="form-group border">
            <div class='row m-2 justify-content-center'>
                <div class="col-2">
                    <label for="first_name">First Name: </label>
                </div>
                <div class="col-4">
                    <input class="form-control" name="first_name" required value='{{ empty($model) ? '' : $model->first_name }}'/>
                </div>        
            </div>
            <div class='row m-2 justify-content-center'>
                <div class="col-2">
                    <label for="last_name">Last Name: </label>
                </div>
                <div class="col-4">
                    <input class="form-control" name="last_name" required value='{{ empty($model) ? '' : $model->last_name }}' />
                </div>
            </div>
            <div class='row m-2 justify-content-center'>
                <div class="col-2">
                    <label for="City">City: </label>
                </div>
                <div class="col-4">
                    <input class="form-control" name="city" required value='{{ empty($model) ? '' : $model->city }}'/>
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