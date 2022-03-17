@extends('layout/master')

@section('konten')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">PIN</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Pin</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <form id="formPin" method="">
      <div class="card">
        <div class="card-body row">
          <div class="col-5 text-center d-flex align-items-center justify-content-center">
            <div class="">
              <img src="{{ asset('dist/img/logo.png') }}" width="250" height="300" alt="User Image">
            </div>
          </div>
          <div class="col-7">
              <div id="alert">

              </div>
            <input type="hidden" name="user_id" id="user_id">
            <div class="form-group">
              <label for="inputEmail">Pin Baru</label>
              <input type="password" id="pin" name="pin" class="form-control" />
            </div>
            <div class="form-group">
              <label for="inputSubject">Konfirmasi PIN</label>
              <input type="password" id="pin_confirmation" name="pin_confirmation" class="form-control" />
            </div>
            <div class="form-group">
              <label for="inputSubject">Masukan Password</label>
              <input type="password" id="password" name="password" class="form-control" />
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary" value="Ubah PIN">
            </div>
          </div>
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
</div>
<script>
  var input = document.getElementById("user_id");
  input.value = sessionStorage.id;
  $('#formPin').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      type:'POST',
      url:'http://127.0.0.1:8000/api/pin/save/',
      data:formData,
      cache:false,
      contentType:false,
      processData:false,
      success:function(data) {
        var htmls='';
        if (data.status==='Password Salah') {
            var htmls='<div class="alert alert-danger alert-dismissible">';
            htmls+='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
            htmls+='<h5><i class="icon fas fa-ban"></i> Alert!</h5>';
            htmls+= data.status+'</div>';
            $('#alert').append(htmls);
            htmls='';
        } else {
            var htmls='<div class="alert alert-success alert-dismissible">';
            htmls+='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
            htmls+='<h5><i class="icon fas fa-check"></i> Alert!</h5>';
            htmls+= data.status+'</div>';
            $('#alert').append(htmls);
            htmls='';
            window.location = "{{ ('dashboard') }}";
        }
      },
      error: function(data) {
        console.log('Error:', data);
      }
    });
  });
</script>
@endsection