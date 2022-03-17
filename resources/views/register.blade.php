<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>E-Surat | Registration Page</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#">Aplikasi Elektronik Persuratan <b>POLRI</b></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Daftar Pengguna Baru</p>
      <form id="registerForm" method="POST">
        @csrf
        <div id="alert">

        </div>
        <div class="input-group mb-3">
          <input type="text" id="name" name="name" class="form-control" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" id="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <span id="notmatch" class="error text-danger"></span>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <a href="{{ url('')}}" class="text-center">Login</a>
    </div>
  </div>
</div>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script>
  $(document).ready(function(){
    $('#registerForm').submit(function(e){
      e.preventDefault();
      var formData = new FormData(this);
      var password = $('#password').val();
      var password_confirmation = $('#password_confirmation').val();
      if (password !== password_confirmation) {
        $('#notmatch').text('Password Tidak Sama');
      }

      $.ajax({
        url: 'http://127.0.0.1:8000/api/register',
        type: 'POST',
        data:formData,
        cache:false,
        contentType:false,
        processData:false,
        success: function(res) {
          if (res.message) {
            var htmls='<div class="alert alert-success alert-dismissible">';
            htmls+='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
            htmls+='<h6><i class="icon fas fa-check"></i> Alert!</h6>';
            htmls+= '<h6>'+res.message+'</h6></div>';
            $('#alert').append(htmls);
            htmls='';
            window.location=  ('{{ url('/') }}');
          } else {
            var htmls='<div class="alert alert-danger alert-dismissible">';
            htmls+='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
            htmls+='<h6><i class="icon fas fa-ban"></i> Alert!</h6>';
            htmls+= '<h6>'+res.error+'</h6></div>';
            $('#alert').append(htmls);
            htmls='';
          }
        }
      })
    })
  });
</script>
</body>
</html>
