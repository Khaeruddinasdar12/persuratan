@extends('layouts.template')

@section('title') Persuratan @endsection

@section('content')

@php 
  $roles = Auth::user()->jabatan;
@endphp
<script type="text/javascript">
  var role_user = '{{$roles}}';
</script>

   <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2> Persuratan</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="text-center">
                        <button onclick="cek(role_user)" class="btn btn-primary tombol">
                          <i class="fa fa-plus"></i> Tambah data persuratan</button>
                      </div >

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Surat Masuk</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Surat Keluar</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                          <table id="table_surat_masuk" class="table table-striped table-bordered" style="width: 100% !important">
			                <thead>
			                  <tr>
                          <th>No. </th>
			                    <th>Judul surat</th>
                          <th>No. surat</th>
			                    <th>Pengirim</th>
			                    <th>Tanggal masuk</th>
			                    <th>Jenis surat</th>
			                    <th>Foto</th>
			                    <th>Created_by</th>
                          <th>Action</th>
			                  </tr>
			                </thead>
			              </table>
                        </div>
                        <div role="tabpanel" class="tab-pane fade active" id="tab_content2" aria-labelledby="profile-tab">
                         <table id="table_surat_keluar" class="table table-striped table-bordered" style="width: 100% !important">
			                <thead>
			                  <tr>
                          <th>No. </th>
			                    <th>Judul surat</th>
                          <th>No. surat</th>
                          <th>Pengirim</th>
                          <th>Tanggal masuk</th>
                          <th>Jenis surat</th>
                          <th>Foto</th>
                          <th>Created_by</th>
                          <th>Action</th>
			                  </tr>
			                </thead>
			              </table>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

<!-- ADD FORM -->
              <div class="modal fade" id="confirm-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-envelope"></i> Tambah Data Persuratan</h4>
    </div>
    <form id="insertdata" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="modal-body">

          <div class="form-group" style="width: 100%;">
            <label for="kondisi" class="control-label">Jenis Surat :</label>
            <select name="jenis_surat" class="form-control" required>
              <option value="" disabled selected>-- jenis surat --</option>
              <option value="surat_masuk" >Surat Masuk</option>
              <option value="surat_keluar" >Surat Keluar</option>
            </select>
          </div>
          <div class="form-group" style="width: 100%;">
            <label for="nama" class="control-label">Nomor Surat :</label>
            <input type="text" name="no_surat" class="form-control" placeholder="Masukkan nomor surat"
            style="width: 100%;" required>
          </div>  
          <div class="form-group" style="width: 100%;">
            <label for="nama" class="control-label">Judul Surat :</label>
            <input type="text" name="judul" class="form-control" placeholder="Masukkan judul surat"
            style="width: 100%;" required>
          </div> 
          <div class="form-group" style="width: 100%;">
            <label for="nama" class="control-label">Pengirim / Penerima</label>
            <input type="text" name="dari_kepada" class="form-control" placeholder="Masukkan pengirim / penerima"
            style="width: 100%;" required>
          </div>
          <div class="form-group" style="width: 100%;">
            <label for="nama" class="control-label">Tanggal Masuk / Tanggal Keluar</label>
            <input type="date" name="tanggal"  class="form-control"
            style="width: 100%;" required>
          </div>
          <div class="form-group" style="width: 100%;">
              <label for="foto" class="control-label">Masukkan Foto Surat : (jpeg,jpg,png)</label>
              <input type="file" name="foto" required>
              <small>Maksimal 2MB</small>
          </div>
        </div>

<div class="modal-footer">
  <button type="reset" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i>Batal</button>
  <button type="submit" id="data" class="btn btn-primary"><i class="fa fa-save"></i>Tambah</button>
</div>

</form>
</div>
</div>
</div>
<!-- END ADD FORM -->

<!-- EDIT FORM -->
<div class="modal fade" id="edit-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Data Persuratan</h4>
    </div>
    <form id="form-edit" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          
          <div class="form-group" style="width: 100%;">
            <label for="kondisi" class="control-label">Jenis Surat :</label>
            <select name="jenis_surat" id="jenis_surat" class="form-control" required>
              <option value="" disabled selected>-- jenis surat --</option>
              <option value="surat_masuk"  id="surat_masuk">Surat Masuk</option>
              <option value="surat_keluar" id="surat_keluar">Surat Keluar</option>
            </select>
          </div>
          <div class="form-group" style="width: 100%;">
            <label for="nama" class="control-label">Nomor Surat :</label>
            <input type="text" name="no_surat" id="no_surat" class="form-control" placeholder="Masukkan nomor surat"
            style="width: 100%;" required>
          </div>  
          <div class="form-group" style="width: 100%;">
            <label for="nama" class="control-label">Judul Surat :</label>
            <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul surat"
            style="width: 100%;" required>
          </div> 
          <div class="form-group" style="width: 100%;">
            <label for="nama" class="control-label">Pengirim / Penerima</label>
            <input type="text" name="dari_kepada" id="pengirim_penerima" class="form-control" placeholder="Masukkan pengirim / penerima"
            style="width: 100%;" required>
          </div>
          <div class="form-group" style="width: 100%;">
            <label for="nama" class="control-label">Tanggal Masuk / Tanggal Keluar</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control"
            style="width: 100%;" required>
          </div>
          <span id="old-foto"></span>
          <div class="form-group" style="width: 100%;">
              <label for="foto" class="control-label">Masukkan Foto Surat : (jpeg,jpg,png)</label>
              <input type="file" name="foto" id="foto">
              <small>Maksimal 2MB</small>
          </div>
        </div>
<input type="hidden" name="hiddenid" id="hidden-id">
<input name="_method" type="hidden" value="PUT">
<div class="modal-footer">
  <button type="reset" class="btn btn-default" data-dismiss="modal">Batal</button>
  <button type="submit" id="data" class="btn btn-primary">Edit</button>
</div>

</form>
</div>
</div>
</div>
<!-- END EDIT FORM -->
@endsection

@section('js')
<script type="text/javascript">
  function cek(jabatan) {
    if(jabatan == 'sekum') {
    $('#confirm-add').modal('show');
   } else {
    wrong_role('Hanya Sekretaris Umum');
   }
  }

function edit(jabatan){
  if (jabatan == 'sekum') {
      $(document).on('click', '#edit-item', function(){
        var id = $(this).attr('data-id');
        $.ajax({
          'url': "persuratan/"+id+"/edit",
          'dataType': 'json',
          success:function(html){
            console.log(html.data.judul);
            $('#judul').val(html.data.judul);
            $('#no_surat').val(html.data.no_surat);
            $('#tanggal').val(html.data.tanggal);
            $('#pengirim_penerima').val(html.data.dari_kepada);
            $('#jenis_surat').val(html.data.jenis_surat);
            $('#hidden-id').val(html.data.id);
            $('#old-foto').html("<a href='storage/"+html.data.foto+"'><img src='storage/"+html.data.foto+"' width='90px'></a>");
            $('#edit-data').modal('show');
          }
        })
      });
  } else {
    wrong_role('Hanya Sekretaris Umum');
  }
 }

  function hapus(jabatan, tabel) {
      if(jabatan == 'sekum' ) {
         hapus_surat(tabel);
      } else {
          wrong_role('Hanya Sekretaris Umum');
      }
    }

  function hapus_surat(tabel) {
     $(document).on('click', '#del_id', function(){
              Swal.fire({
                title: 'Anda Yakin ?',
                text: "Anda tidak dapat mengembalikan data yang telah di hapus!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjutkan Hapus!',
                timer: 6500
              }).then((result) => {
                  if (result.value) {
                    var me = $(this),
                        url = me.attr('href'),
                        token = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                          url: url,
                          method: "POST",
                          data : {
                            '_method' : 'DELETE',
                            '_token'  : token
                          },
                          success:function(data){
                            console.log(tabel);
                            berhasil(data.status, data.pesan);
                            $(tabel).DataTable().ajax.reload();
                          },
                          error: function(xhr, status, error){
                              var error = xhr.responseJSON; 
                              if ($.isEmptyObject(error) == false) {
                                $.each(error.errors, function(key, value) {
                                  gagal(key, value);
                                });
                              }
                          } 
                        });
                      }
                  });
              });
   }

     $('#form-edit').submit(function(e){
    e.preventDefault();
    var id  = eval(document.getElementById('hidden-id').value);
    var request = new FormData(this);
    var endpoint= "persuratan/"+id;
          $.ajax({
            url: endpoint,
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            // dataType: "json",
            success:function(data){
              $('#form-edit')[0].reset();
              $('#edit-data').modal('hide');
              console.log(data.reload);
              if(data.reload == 'reload_all_table') {
                $('#table_surat_masuk').DataTable().ajax.reload();
                $('#table_surat_keluar').DataTable().ajax.reload();
              } else if (data.reload == 'surat_masuk') {
                $('#table_surat_masuk').DataTable().ajax.reload();
              } else if (data.reload == 'surat_keluar') {
                $('#table_surat_keluar').DataTable().ajax.reload();
              }
              berhasil(data.status, data.pesan);
            },
            error: function(xhr, status, error){
                var error = xhr.responseJSON; 
                if ($.isEmptyObject(error) == false) {
                  $.each(error.errors, function(key, value) {
                    gagal(key, value);
                  });
                }
                } 
            }); 
});


</script>

<script>
   $('#insertdata').submit(function(e){
    e.preventDefault();
    
    var request = new FormData(this);
    var endpoint= '{{ route("persuratan.store") }}';
          $.ajax({
            url: endpoint,
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            // dataType: "json",
            success:function(data){
              $('#insertdata')[0].reset();
              $('#confirm-add').modal('hide');
              console.log(data.surat);
              berhasil(data.status, data.pesan);
              if(data.surat == 'surat_masuk') {
                $('#table_surat_masuk').DataTable().ajax.reload();
              } else if (data.surat == 'surat_keluar') {
                $('#table_surat_keluar').DataTable().ajax.reload();
              }
              
            },
            error: function(xhr, status, error){
                var error = xhr.responseJSON; 
                if ($.isEmptyObject(error) == false) {
                  $.each(error.errors, function(key, value) {
                    gagal(key, value);
                  });
                }
                } 
            }); 
      });

$(document).ready(function(){
    $('#table_surat_masuk').DataTable({
        // "processing": true,
        "serverSide": true,
        // "paging"    : true,
        "deferRender": true,
        "ordering": true,
        "order": [[ 0, 'asc' ]],
        "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]],
        "ajax":  {
                "url":  '{{route("surat_masuk")}}', // URL file untuk proses select datanya
                "type": "GET"
              },
        "columns": [
            { "data": "DT_RowIndex" },
            { "data": "judul" },
            { "data": "no_surat" },
            { "data": "dari_kepada" },
            { "data": "tanggal" },
            { "data": "jenis_surat" },
            { "data": "foto" },
            { "data": "namaadmin" },
            { "data": "action" }
            // { "data": "action" }
        ]
    });
});
</script>
<script>
 $(document).ready(function(){ 
    $('#table_surat_keluar').DataTable({
        // "processing": true,
        "serverSide": true,
        "deferRender": true,
        "ordering": true,
        "order": [[ 0, 'asc' ]],
        "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]],
        "ajax":  {
                "url":  '{{route("surat_keluar")}}', // URL file untuk proses select datanya
                "type": "GET"
              },
        "columns": [
            { "data": "DT_RowIndex" },
            { "data": "judul" },
            { "data": "no_surat" },
            { "data": "dari_kepada" },
            { "data": "tanggal" },
            { "data": "jenis_surat" },
            { "data": "foto" },
            { "data": "namaadmin" },
            { "data": "action" }
            // { "data": "action" }
        ]
    });
});
</script>

@endsection