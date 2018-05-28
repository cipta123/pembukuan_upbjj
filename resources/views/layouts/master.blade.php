<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('js/printpreview.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/mystyle.css') }}">

         <style type="text/css">

 body { font-family: Calibri, Helvetica, Arial; }
 #navbar {
  overflow: hidden;
  background-color: #333;
}

#navbar a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

#navbar a:hover {
  background-color: #ddd;
  color: black;
}

#navbar a.active {
  background-color: #f7d518;
  color: white;
}

.content {
  padding: 16px;
}

.sticky {
  position: fixed;
  top: 0;
  width: 100%;
}

.sticky + .content {
  padding-top: 60px;
}

@yield('headcss')
        </style>


 
    </head>
    <body>
        <div id="navbar">
          <a class="active" href="#"><img src="{{ asset('img/Logo-UT.png') }}" height="35px" width="35px"></a>
          <a href="http://localhost/pembukuan/entry">Entri</a>
          <a href="http://localhost/pembukuan/laporan">Buku Pembantu</a>
       </div>
@yield('content')
 


<div class="footer">
  <img src="{{ asset('img/footer-logo.png') }}" height="150px" width="100%">
</div>

@yield('script')

    </body>
</html>
