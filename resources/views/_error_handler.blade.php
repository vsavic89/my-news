@section('error_handler')    
    @if (!empty($errors) && $errors->any())
        <h1>Error Results</h1>
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection