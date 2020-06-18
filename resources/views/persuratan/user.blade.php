@extends('layouts.template')

@section('title') Data Anggota @endsection

@section('content')
<div style="display: none" id="role_user">
@php 
  $roles = Auth::user()->jabatan;
@endphp
<script type="text/javascript">
  var role_user = '{{$roles}}';
</script>
</div>
 <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Data Anggota </h2>

              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="text-center">
                <button class="btn btn-primary tombol" onclick="cek(role_user)">
                  <i class="fa fa-plus" ></i> Tambah data</button>
              </div>
              <table id="table" class="table table-striped table-bordered"><!-- Serverside -->
                <thead>
                  <tr>
                    <th>No. </th>
                    <th>Nama</th>
                    <th>Noreg</th>
                    <th>Email</th>
                    <th>No Telephone</th>
                    <th>Jabatan</th>
                    <th>Status Surat</th>
                    <th>Foto</th>
                    <th>Action</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>

<!-- FORM ADD USER -->
        <div class="modal fade" id="confirm-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
          aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Tambah Data User</h4>
              </div>
              <form id="input_user" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                  <div class="form-group" style="width: 100%;">
                    <label for="kodbar" class="control-label" style="padding-top: 10px;">Nama 
                      :</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama"
                      style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="nama" class="control-label">Email : </label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email"
                      style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="nama" class="control-label">Password : </label>
                    <input type="text" name="password" class="form-control" placeholder="Masukkan password"
                      style="width: 100%;" id="pass" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="nama" class="control-label">Konfirmasi Password : </label>
                    <input type="text" class="form-control" placeholder="Masukkan ulang password" style="width: 100%;" id="konf_pass" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="jumlah" class="control-label">No. Hp/Telp : </label>
                    <input type="text" name="phone" class="form-control" placeholder="Masukkan No.Hp/Telp" maxlength="13"
                      style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="jumlah" class="control-label">No. Registrasi Anggota (NRA) : </label>
                    <input type="text" name="noreg" class="form-control" placeholder="ex(829.KD.XVII.18)" maxlength="14"
                      style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="jumlah" class="control-label">Status Surat : </label>
                    <input type="text" name="status_surat" class="form-control" placeholder="Masukkan Status Surat Anggota"  style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="kondisi" class="control-label">Jabatan : </label>
                    <select name="jabatan" class="form-control" required>
                      <option value="" disabled selected>-- Jabatan --</option>
                      <option value="kord_dpo" >Koordinator Dewan Penasehat Organisasi</option>
                      <option value="dpo" >Dewan Penasehat Organisasi</option>
                      <option value="kord_tim_ahli" >Koordinator Tim Ahli</option>
                      <option value="tim_ahli" >Tim Ahli</option>
                      <option value="ketum" >Ketua Umum</option>
                      <option value="sekum" >Sekretaris Umum</option>
                      <option value="bendum" >Bendahara Umum</option>
                      <option value="wk1" >Wakil Ketua 1</option>
                      <option value="wk2" >Wakil Ketua 2</option>
                      <option value="kord_keorganisasian" >Koordinator Keorganisasian</option>
                      <option value="staff_keorganisasian" >Staff Keorganisasian</option>
                      <option value="kord_P&R" >Koordinator Public & Relation</option>
                      <option value="staff_P&R" >Staff Public & Relation</option>
                      <option value="kord_tools" >Koordinator Tools & Properties</option>
                      <option value="satff_tools" >Staff Tools & Properties</option>
                      <option value="kord_keilmuan" >Koordinator Keilmuan</option>
                      <option value="kord_program" >Koordinator Program</option>
                      <option value="staff_program" >Staff Program</option>
                      <option value="kord_jaringan" >Koordinator Jaringan</option>
                      <option value="staff_jaringan" >Staff Jaringan</option>
                      <option value="kord_hardware" >Koordinator Hardware</option>
                      <option value="staff_hardware" >Staff Hardware</option>
                      <option value="kord_multimedia" >Koordinator Multimedia</option>
                      <option value="staff_multimedia" >Staff Multimedia</option>
                      <option value="all_crew" >All Crew</option>
                    </select>
                  </div>
                  <div class="form-group" style="width: 100%;">
                      <label for="foto" class="control-label">Masukkan Foto Surat : (jpeg,jpg,png)</label>
                      <input type="file" name="foto" id="foto">
                      <small>Maksimal 2MB</small>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
              </form>
            </div>
          </div>
        </div>
<!-- END FORM ADD USER -->


<!-- FORM EDIT DATA USER -->
<div class="modal fade" id="confirm-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
          aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Tambah Data User</h4>
              </div>
              <form id="edit-user" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                  <div class="form-group" style="width: 100%;">
                    <label for="kodbar" class="control-label" style="padding-top: 10px;">Nama 
                      :</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama"
                      style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="nama" class="control-label">Email : </label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email" disabled="" 
                      style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="jumlah" class="control-label">No. Hp/Telp : </label>
                    <input type="text" name="phone" id="nohp" class="form-control" placeholder="Masukkan No.Hp/Telp" maxlength="13"
                      style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="jumlah" class="control-label">No. Registrasi Anggota (NRA) : </label>
                    <input type="text" name="noreg" id="noreg" class="form-control" placeholder="ex(829.KD.XVII.18)" maxlength="14"
                      style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="jumlah" class="control-label">Status Surat : </label>
                    <input type="text" name="status_surat" id="status_surat" class="form-control" placeholder="Masukkan Status Surat Anggota"  style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="kondisi" class="control-label">Jabatan : </label>
                    <select name="jabatan" id="jabatan" class="form-control" required>
                      <option value="" disabled selected>-- Jabatan --</option>
                      <option value="kord_dpo" >Koordinator Dewan Penasehat Organisasi</option>
                      <option value="dpo" >Dewan Penasehat Organisasi</option>
                      <option value="kord_tim_ahli" >Koordinator Tim Ahli</option>
                      <option value="tim_ahli" >Tim Ahli</option>
                      <option value="ketum" >Ketua Umum</option>
                      <option value="sekum" >Sekretaris Umum</option>
                      <option value="bendum" >Bendahara Umum</option>
                      <option value="wk1" >Wakil Ketua 1</option>
                      <option value="wk2" >Wakil Ketua 2</option>
                      <option value="kord_keorganisasian" >Koordinator Keorganisasian</option>
                      <option value="staff_keorganisasian" >Staff Keorganisasian</option>
                      <option value="kord_P&R" >Koordinator Public & Relation</option>
                      <option value="staff_P&R" >Staff Public & Relation</option>
                      <option value="kord_tools" >Koordinator Tools & Properties</option>
                      <option value="satff_tools" >Staff Tools & Properties</option>
                      <option value="kord_keilmuan" >Koordinator Keilmuan</option>
                      <option value="kord_program" >Koordinator Program</option>
                      <option value="staff_program" >Staff Program</option>
                      <option value="kord_jaringan" >Koordinator Jaringan</option>
                      <option value="staff_jaringan" >Staff Jaringan</option>
                      <option value="kord_hardware" >Koordinator Hardware</option>
                      <option value="staff_hardware" >Staff Hardware</option>
                      <option value="kord_multimedia" >Koordinator Multimedia</option>
                      <option value="staff_multimedia" >Staff Multimedia</option>
                      <option value="all_crew" >All Crew</option>
                    </select>
                  </div>
                  <input type="hidden" name="hiddenid" id="hidden-id">
                  <input name="_method" type="hidden" value="PUT">
                  <span id="old-foto"></span>
                  <div class="form-group" style="width: 100%;">
                      <label for="foto" class="control-label">Masukkan Foto Surat : (jpeg,jpg,png)</label>
                      <input type="file" name="foto" id="foto">
                      <small>Maksimal 2MB</small>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- END FORM EDIT DATA USER -->
@endsection

@section('js')
<script type="text/javascript">
  $('#edit-user').submit(function(e){
    e.preventDefault();
    var id  = eval(document.getElementById('hidden-id').value);
    var request = new FormData(this);
    var endpoint= "user/"+id;
          $.ajax({
            url: endpoint,
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            // dataType: "json",
            success:function(data){
              // console.log(data);
              $('#edit-user')[0].reset();
              $('#confirm-edit').modal('hide');
              // $('#role_user').load();
              role_user = data.role;
              berhasil(data.status, data.pesan);
              // tablebarang();
              if(data.status == 'success')
              $('#table').DataTable().ajax.reload();
              // $('#datatable').ajax.reload();
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

$('#input_user').submit(function(e){
    e.preventDefault();
    var password  = document.getElementById('pass').value;
    var konf_pass = document.getElementById('konf_pass').value;

    if(password != konf_pass) {
      var key   = 'Password';
      var pesan = 'tidak sama'; 
      return gagal(key, pesan);
    }

    var request = new FormData(this);
    var endpoint= '{{ route("registrasi") }}';
          $.ajax({
            url: endpoint,
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
              // console.log(data);
              if(data.status == 'success') {
                $('#input_user')[0].reset();
                $('#confirm-add').modal('hide');
                $('#table').DataTable().ajax.reload();
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

$(document).ready(function() {
    $('#table').DataTable({
        // "processing": true,
        "serverSide": true,
        "deferRender": true,
        "ordering": true,
        "order": [[ 0, 'desc' ]],
        "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]],
        "ajax":  {
                "url":  '{{route("tableuser")}}', // URL file untuk proses select datanya
                "type": "GET"
              },
        "columns": [
            { "data": "DT_RowIndex" },
            { "data": "name" },
            { "data": "noreg" },
            { "data": "email" },
            { "data": "phone" },
            { "data": "jabatan" },
            { "data": "status_surat" },
            { "data": "foto" },
            { "data": "action" }
        ]
    });
});

 function cek(role) {
   if(role != 'sekum') {
    wrong_role('Hanya Sekretaris Umum');
   } else {
    $('#confirm-add').modal('show');
   }
 }

 function cek_edit(role) {
   if(role != 'sekum') {
    wrong_role('Hanya Sekretaris Umum');
   } else {
    $(document).on('click', '#edit-item', function(){
      $('#edit-user')[0].reset();
    var id = $(this).attr('data-id');
    $.ajax({
      'url': "user/"+id+"/edit",
      'dataType': 'json',
      success:function(html){
        $('#hidden-id').val(html.data.id);
        $('#name').val(html.data.name);
        $('#email').val(html.data.email);
        $('#nohp').val(html.data.phone);
        $('#noreg').val(html.data.noreg);
        $('#status_surat').val(html.data.status_surat);
        $('#jabatan').val(html.data.jabatan);
        $('#old-foto').html("<a href='storage/"+html.data.foto+"'><img src='storage/"+html.data.foto+"' width='90px' alt='"+html.data.name+"'></a>");
        // if(html.data.roles == 'superadmin') {
        //   $("#superadmin").attr('checked', 'checked');
        // } else {
        //   $("#admin").attr('checked', 'checked');
        // }
        $('#confirm-edit').modal('show');
      }
    })
  })
   }
 }

function hapus_cek(role) {
  if(role != 'sekum') {
    wrong_role('Hanya Sekretaris Umum');
   } else {
    $(document).on('click', '#del_user', function(){
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
                    berhasil(data.status, data.pesan);
                    if(data.status == 'success')
                    $('#table').DataTable().ajax.reload();
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
}
      </script>

@endsection