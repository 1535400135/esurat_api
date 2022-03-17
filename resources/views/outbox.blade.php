@extends('layout/master')

@section('konten')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">OUTBOX</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Outbox</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Outbox</h3>
          </div>
          
          <!-- /.card-header -->
          <div class="card-body">    
            <button class="btn btn-primary" data-toggle="modal" data-target="#modal-new">Buat Email Baru</button>
            <br><br>
            <table id="dataTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width: 10%">Nomor</th>
                  <th style="width: 25%">Penerima</th>
                  <th style="width: 50%">Subject</th>
                  <th style="width: 15%">Action</th>
                </tr>
              </thead>
              <tbody id="data">

              </tbody>
            </table>
        </div>
        </div>
    </div>
    <form method="POST" enctype="multipart/form-data" id="upload-file">
      <div class="modal fade" id="modal-new">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Buat Email Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="card-body">
                  <div class="form-group">
                    <input type="hidden" name="user_id" id="user_id">
                    <input type="hidden" name="email" id="email">
                    <select name="to_id" id="to_id" class="form-control select2" style="widht:100%">
                    
                    </select>
                  </div>
                  <div class="form-group">
                    <input class="form-control" name="subject" id="subject" placeholder="Subject:">
                  </div>
                  <div class="form-group">
                    <input class="form-control" name="ket" id="ket" placeholder="Keterangan">
                  </div>
                  <div class="form-group">
                      <textarea id="compose-textarea" name="isi" id="isi" class="form-control" style="height: 300px">
                      </textarea>
                  </div>
                  <div class="form-group">
                    <div class="btn btn-default btn-file">
                      <i class="fas fa-paperclip"></i> Masukan File
                      <input type="file" name="file" id="file">
                    </div>
                    <p class="help-block">Max. 3MB</p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" name="pin" id="pin" type="password" placeholder="Masukan PIN Anda" required>
                  </div>
                </div>
                <div id="alert"></div>
              </div>
              <div class="modal-footer justify-content-between">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary" id="save"><i class="far fa-envelope"></i> Send</button>
                  </div>
                  <button type="reset" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i> Discard</button>
              </div>
            </div>
          </div>
      </div>
    </form>
</div>
<script>
  var input = document.getElementById("user_id");
  var email = document.getElementById("email");
  var id = sessionStorage.id;
  var token = sessionStorage.token;
  sessionStorage.removeItem('id_pesan');
  input.value = id;
  email.value = sessionStorage.email;
  $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    'Authorization': 'Bearer '+token,
    }
  });
  $('.select2').select2({
      theme: 'bootstrap4'
  })
  $.ajax({
    url:'http://127.0.0.1:8000/api/outbox/'+id,
    type:'GET',
    success:function(e){
        var data = e.data;
        var status = e.message;
        var pengguna = e.pengguna;
        var htmls='';
        if (status==='true') {
          $('#dataTable').dataTable( {
            "language": {
              "emptyTable": "Belum Ada Pesan Keluar"
            }
          });
          for(var j=0 ; j<pengguna.length ; j++){
            var user='<option value="'+pengguna[j].id+'">'+pengguna[j].email+'</option>';
            $('#to_id').append(user);
            user='';
          }
        }
        if (status==='false') {
          for(var i=0 ; i<data.length ; i++){
            var htmls='<tr>';
            htmls+= '<td>' +(i+1)+'</td>';
            htmls+= '<td>' +data[i].email+'</td>';
            htmls+= '<td>' +data[i].subject+'</td>';
            htmls+= '<td><button class="btn btn-primary" onclick="viewPin('+data[i].id+')">View</button> <button class="btn btn-danger" onclick="deleteData('+data[i].id+')">Delete</button></td>';
            htmls+='</tr>';
            $('#data').append(htmls);
            htmls='';
          }  
          for(var j=0 ; j<pengguna.length ; j++){
            var user='<option value="'+pengguna[j].id+'">'+pengguna[j].email+'</option>';
            $('#to_id').append(user);
            user='';
          }
          $('#dataTable').dataTable();
        }
        
    },
    error:function(e) {
      console.log('Error:', e);
    }
});
function deleteData($id){
    sessionStorage.setItem('id_pesan', $id);
    window.location = 'http://localhost:8000/delete/outbox/'+$id;
}

function viewPin($id){
    sessionStorage.setItem('id_pesan', $id);
    window.location = 'http://localhost:8000/keluar/pin/'+$id;
}

$(document).ready( function (e) {
  $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    'Authorization': 'Bearer '+token,
    }
  });
  $('#upload-file').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      type:'POST',
      url:'http://127.0.0.1:8000/api/outbox/save',
      data:formData,
      cache:false,
      contentType:false,
      processData:false,
      success:function(data) {
        if (data.success) {
          location.reload();
            var htmls='<div class="alert alert-success alert-dismissible">';
            htmls+='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
            htmls+='<h6><i class="icon fas fa-check"></i>Pesan Berhasil Terkirim !</h6>';
            htmls+= '</div>';
            $('#alert').append(htmls);
            htmls='';
        } else {
            var htmls='<div class="alert alert-danger alert-dismissible">';
            htmls+='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
            htmls+='<h6><i class="icon fas fa-ban"></i> PIN Salah !</h6>';
            htmls+= '</div>';
            $('#alert').append(htmls);
            htmls='';
        }
      },
      error: function(data) {
        console.log('Error:', data);
      }
    });
  });
});
</script>
@endsection