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
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="/my-news"><u class="badge-primary p-2">My News</u></a>                
                <a class="navbar-link" href="/api/authors">Authors</a> 
              </nav>
            @yield('content')
            @yield('error_handler')
        </div>                
    </body>
</html>