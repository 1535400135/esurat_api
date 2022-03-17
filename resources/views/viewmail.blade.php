@extends('layout/master')

@section('konten')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Surat</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">View Surat</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="card">        
        <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Read Mail</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h5 id="subject"></h5>
                <h6 id="ket"></h6>
                <h6 id="from"></h6>
              </div>
              <div class="mailbox-read-message" id="isi">
                
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer bg-white">
              <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                <li>
                  <span class="mailbox-attachment-icon"><i class="far fa-file"></i></span>

                  <div class="mailbox-attachment-info" id="file">
                    {{-- <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> Sep2014-report.pdf</a>
                        <span class="mailbox-attachment-size clearfix mt-1">
                          <span>1,245 KB</span>
                          <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                        </span> --}}
                  </div>
                </li>
              </ul>
            </div>
            <!-- /.card-footer -->
            <div class="card-footer">
              <div class="float-right">
                <!-- <button type="button" class="btn btn-default"><i class="fas fa-reply"></i> Reply</button>
                <button type="button" class="btn btn-default"><i class="fas fa-share"></i> Forward</button> -->
              </div>
              <button type="button" class="btn btn-default" id="delete" onclick="deleteData('{{ $data }}')"><i class="far fa-trash-alt"></i> Delete</button>
              <a href="{{ url('/dashboard') }}" class="btn btn-default" id="back">Back</a>
              <!-- <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button> -->
            </div>
            <!-- /.card-footer -->
          </div>
      </div>
    </div>
</div>
<script>
  $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    'Authorization': 'Bearer '+sessionStorage.token,
    }
  });
  $.ajax({
    url:'http://127.0.0.1:8000/api/show/in/{{ $data }}',
    type:'GET',
    success:function(e){
      var siteurl = '{{ asset('') }}';
        var htmls='';
            var subject=e.subject;
            var from='From : '+e.email;
            var ket='Keterangan : '+e.ket;
            var isi='<p>'+e.isi+'</p>';
            var file = '<a href="'+siteurl+e.file+'" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> '+e.file+'</a>';
            file+='<span class="mailbox-attachment-size clearfix mt-1"><a href="'+siteurl+e.file+'" class="btn btn-default btn-sm float-right">';
            file+= '<i class="fas fa-cloud-download-alt"></i></a></span>';
            // htmls+= '<td>' +(i+1)+'</td>';
            // htmls+= '<td>' +data[i].email+'</td>';
            // htmls+= '<td>' +data[i].subject+'</td>';
            // htmls+= '<td><button class="btn btn-primary" onclick="viewPin('+data[i].id+')">View</button> <button class="btn btn-danger" onclick="deleteData('+data[i].id+')">Delete</button></td>';
            // htmls+='</tr>';
            $('#subject').append(subject);
            $('#from').append(from);
            $('#ket').append(ket);
            $('#isi').append(isi);
            $('#file').append(file);
      },
      error:function(e){
        console.log('Error:', e);
      }
});
function deleteData($id){
    $.ajax({
        url:'http://127.0.0.1:8000/api/delete/'+$id,
        type:'DELETE',
        success:function(){
            window.location='/dashboard';
        }
    });
}
</script>
@endsection