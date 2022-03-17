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
            <div class="form-group">
              <label for="inputName">Masukan PIN</label>
              <input type="password" id="pin" name="pin" class="form-control" />
              <input type="hidden" name="user_id" id="user_id">
              <input type="hidden" name="id" id="id">
            </div>
            <div class="form-group">
              <label for="inputSubject">Konfirmasi PIN</label>
              <input type="password" id="pin_confirmation" name="pin_confirmation" class="form-control" />
            </div>
            <div class="form-group">
                <a href="{{ url('/dashboard') }}" class="btn btn-default">Batal</a>
              <input type="submit" id="save" class="btn btn-primary" value="OK">
            </div>
          </div>
        </div>
      </div>
      </form>

    </section>
    <!-- /.content -->
</div>
<script>
  $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    'Authorization': 'Bearer '+sessionStorage.token,
    }
  });
  var input = document.getElementById("user_id");
  input.value = sessionStorage.id;
  var id = document.getElementById("id");
  id.value = sessionStorage.id_pesan;
    $('#formPin').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    var pin = $("#pin").val();
    var pin_confirmation = $("#pin_confirmation").val();
    $.ajax({
      type:'POST',
      url:'http://127.0.0.1:8000/api/inbox/del',
      data:formData,
      cache:false,
      contentType:false,
      processData:false,
        success: function(e){
            var status = e.status;
            if (pin===pin_confirmation) {
                if (status==='success') {
                  window.location = 'http://localhost:8000/masuk';
                } else {
                    location.reload();
                }
            } else {
                location.reload();
            }
        }, 
        error: function(data) {
          console.log('Error:', data);
        }
      });
    });
</script>
@endsection