<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        
       <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{ asset("css/bootstrap.css") }}">
        <script src="{{ asset("js/jquery.js") }}"></script>
        <script src="{{ asset("js/bootstrap.min.js") }}"></script>
<style>
  #wrapper{
    display: 
  }
</style>
    </head>
    <body>
    
<div id="wrapper">
  <h2>cipta</h2>


</div>





<script>
    //--------------------CSRF TOKEN AJAX----------------//
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
    //-------------------- END OF CSRF TOKEN AJAX----------------//

    $('#loginGo').on('click',function(){
        var usr = $('#username').val();
        var pwd = $('#password').val();
         
        if (usr.length==0 || pwd.length==0) {
            alert('Silakan Lengkapi dulu form nya');
        } else{
            $.ajax({
        type : 'POST',
        url  : "{{ URL::to('login/validate') }}",
        data : {usr:'usr',pwd:'pwd'},
        success:function(data){
                alert(data);
            }
        });
   }
    });
@yield('script')
    
</script>

    </body>
</html>
