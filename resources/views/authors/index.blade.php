@extends('master')
@section('content')
<div class="alert alert-info text-center">
    <h1>List of authors</h1>
</div>
@if(count($authors) > 0)
    <table class="display" id="authors" style="width:100%">
        <thead>
            <tr>
                <th>
                    Full Name
                </th>
                <th>
                    City
                </th>
            </tr>  
        </thead>
        <tbody>
        @foreach($authors as $author)
            <tr>
                <td>{{ $author->full_name }}</td>
                <td>{{ $author->city }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div class='alert alert-danger'>
        <h4>No authors to show!</h4>
    </div>
@endif
<script type="text/javascript">
    $(document).ready(function() {
        $('#authors').DataTable();
    } );
</script>
@endsection