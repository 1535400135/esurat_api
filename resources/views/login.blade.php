<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AdminLTE 3 | Log in</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css')}}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#">Aplikasi Elektronik Persuratan <b>POLRI</b></a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Selamat datang dan silahkan login</p>
      <div id="alert">

      </div>
      <form id="loginForm" method="post">
        @csrf
        <span id="error" class="error text-danger"></span>
        <span id="token" class="error text-danger"></span>
        <span id="id-text" class="error text-danger"></span>
        <div class="input-group mb-3">
          <input type="email" name="email" id="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" id="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <a href="{{ url('register') }}" class="btn btn-default btn-block">Daftar Baru</a>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" id="login">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->


<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('plugins/toastr/toastr.min.js')}}"></script>
<script src="{{ asset('dist/js/adminlte.min.js')}}"></script>
<script>
   $(document).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#loginForm').submit(function(e){
      e.preventDefault();
      var email = $('#email').val();
      var password = $('#password').val();

      $.ajax({
        url:'http://127.0.0.1:8000/api/login',
        type:'post',
        data:{
          'email':email, 'password':password
        },
        success:function(res) {
          if(res.error) {
            var htmls='<div class="alert alert-danger alert-dismissible">';
            htmls+='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
            htmls+='<h6><i class="icon fas fa-ban"></i> Alert!</h6>';
            htmls+= '<h6>'+res.error+'</h6></div>';
            $('#alert').append(htmls);
            htmls='';
          }
          if(res.success) {
            var htmls='<div class="alert alert-success alert-dismissible">';
            htmls+='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
            htmls+='<h6><i class="icon fas fa-check"></i> Alert!</h6>';
            htmls+= '<h6>'+res.success+'</h6></div>';
            $('#alert').append(htmls);
            htmls='';
            sessionStorage.setItem('token', res.token);
            sessionStorage.setItem('id', res.data.id);
            sessionStorage.setItem('name', res.data.name);
            sessionStorage.setItem('email', res.data.email);
            window.location = "{{ ('dashboard') }}";
          }
        }
      })
    })
  });
</script>
</body>
</html>
