@extends('layout/master')

@section('konten')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">INBOX</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inbox</a></li>
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
            <h3 class="card-title">Data Inbox</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="dataTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width: 10%">Nomor</th>
                  <th style="width: 25%">Pengirim</th>
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
    {{-- <div class="modal fade" id="modal-pin">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Masukan PIN</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="number" name="pin" id="pin" class="form-control">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="viewItem()">OK</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div> --}}
    {{-- <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Apakah Anda Yakin Ingin Menghapus Pesan ?</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>            
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-primary" onclick="deleteData('+data[i].id+')">Hapus</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div> --}}
    <!-- /.content -->
</div>
<script>
var id = sessionStorage.id;
var token = sessionStorage.token;
sessionStorage.removeItem('id_pesan');
$.ajaxSetup({
  headers: {
  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
  'Authorization': 'Bearer '+token,
  }
});
$.ajax({
    url:'http://127.0.0.1:8000/api/inbox/'+id,
    type:'GET',
    success:function(e){
        var status = e.message;
        var data = e.data;
        var htmls='';
        if (status==='true') {
          $('#dataTable').dataTable( {
            "language": {
              "emptyTable": "Belum Ada Pesan Masuk"
            }
          });
          // var html='<tr><td style="width:100%">Maaf Belum Ada Pesan Masuk</td>';
          // $('#data').append(htmls);
          // htmls='';
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
          $('#dataTable').dataTable();
        }
    }
});

function deleteData($id){
  sessionStorage.setItem('id_pesan', $id)
  window.location = 'http://localhost:8000/delete/inbox/'+$id;
}

function viewPin($id){
  sessionStorage.setItem('id_pesan', $id)
  window.location = 'http://localhost:8000/masuk/pin/'+$id;
}

</script>
@endsection