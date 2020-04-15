@extends('master')
@section('content')
<div class="jumbotron jumbotron-fluid alert-info">
  <div class="container">
      <span class="alert-dark">
        <h1 class="display-4">Welcome to My News</h1>
        <p class="lead">The place where news are fun. :O</p>
      </span>      
  </div>
</div>
    <div class="container alert-warning">
        <div class="text-center text-dark">
            <h1><u>Environment Variables</u></h1>  
        </div>  
        <div class="text-dark">
            <h3>APP_ENV: {{ config('app.env') }}</h3>
            <h3>APP_NAME: {{ config('app.name') }}</h3>
            <h3>APP_KEY: {{ config('app.key') }}</h3>
            <h3>APP_DEBUG: {{ config('app.debug') }}</h3>
            <h3>APP_URL: {{ config('app.url') }}</h3>
        </div>
  </div>
@endsection