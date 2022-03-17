@extends('layout/master')

@section('konten')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Profile</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="m-0">Masukan Data Diri</h5>
                    </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input class="form-control" name="nama" placeholder="Masukan Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label for="">Tempat Lahir</label>
                                <input class="form-control" name="tempat" placeholder="Masukan Tempat Lahir">
                            </div>
                            <div class="col-2">
                                <label for="">Pilih Tanggal</label>
                                <select name="tanggal" id="" class="form-control">
                                    <option value="6">6</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <label for="">Bulan</label>
                                <select name="bulan" id="" class="form-control">
                                    <option value="Agustus">Agustus</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <label for="">Tahun</label>
                                <select name="tahun" id="" class="form-control">
                                    <option value="1979">1979</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Kelamin</label>
                        <select name="jk" class="form-control" id="">
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label for="">PIN</label>
                                <input class="form-control" name="pin" placeholder="6 Kombinasi Angka" maxlength="6" type="number">
                            </div>
                            <div class="col-6">
                                <label for="">Konfirmasi PIN</label>
                                <input class="form-control" name="konfirmasiPin" placeholder="Konfirmasi PIN" maxlength="6" type="number">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="btn btn-default btn-file">
                            <i class="fas fa-paperclip"></i> Masukan Foto
                            <input type="file" name="attachment">
                        </div>
                        <p class="help-block">Max. 3MB</p>
                    </div>
                </div>
                <div class="card-footer justify-content-between">
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection