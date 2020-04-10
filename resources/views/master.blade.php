<!DOCTYPE html>
<html>
    <head>
       <link href="/css/app.css" rel="stylesheet"/>
       <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
       <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>       
       <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>       
    </head>
    <body>
        <div class='container'>
            <nav class="navbar navbar-expand-lg navbar-light bg-light pl-0 pt-2 pb-2">
                <a class="navbar-brand mr-5 ml-0" href="/my-news"><u class="badge-primary p-2">My News</u></a>                
                <a class="navbar-link mr-5" href="/authors">Authors</a> 
                <a class="navbar-link mr-5" href="/articles">Articles</a> 
                <a class="navbar-link mr-5" href="/tags">Tags</a> 
              </nav>
            @yield('content')
            @yield('error_handler')
        </div>                
        <script type="text/javascript">
            $(document).ready(function() {
                $('.table').DataTable();
            } );
        </script>
    </body>
</html>