@extends('layouts.template')

@section('title') Data barang @endsection

@section('content')
@php 
  $jabatan = Auth::user()->jabatan;
@endphp

<script type="text/javascript">
  var jabatan = '{{$jabatan}}';
</script>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Data Barang</h2>

      <div class="clearfix"></div>
  </div>
  <div class="x_content" >
      <div class="text-center">
        <button onclick="cek(jabatan)" class="btn btn-primary tombol">
          <i class="fa fa-plus"></i> Tambah data</button>
      </div >
      <table id="table" class="table table-striped table-bordered">
        <thead>
          <tr >
            <th>No.</th>
            <th>Nama</th>
            <th>Kondisi</th>
            <th>Jumlah</th>
            <th>Stok</th>
            <th>Tanggal Masuk</th>
            <th>Foto Barang</th>
            <th>Created_by</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
</div>
</div>
</div>


<div class="modal fade" id="confirm-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Barang</h4>
    </div>
    <form id="insertdata" method="POST" enctype="multipart/form-data" >
        @csrf
        <div class="modal-body">  
          <div class="form-group" style="width: 100%;">
            <label for="nama" class="control-label">Nama :</label>
            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Barang"
            style="width: 100%;" required>
        </div>
        <div class="form-group" style="width: 100%;">
            <label for="kondisi" class="control-label">Kondisi :</label>
            <select name="kondisi" id="kondisi" class="form-control" required>
              <option value="" disabled selected>-- kondisi barang --</option>
              <option value="Layak Pakai" >Layak Pakai</option>
              <option value="Tidak Layak Pakai">Tidak Layak Pakai</option>
          </select>
      </div>
      <div class="form-group" style="width: 100%;">
        <label for="jumlah" class="control-label">Jumlah :</label>
        <input type="text" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah Barang" maxlength="13"
        style="width: 100%;" required>
    </div>
    <div class="form-group" style="width: 100%;">
        <label for="stok" class="control-label">Stok :</label>
        <input type="text" id="stok" name="stok" class="form-control" placeholder="Stok Barang Yang Ada Sekarang"
        style="width: 100%;" required>
    </div>
    <div class="form-group" style="width: 100%;">
        <label for="foto" class="control-label">Masukkan Foto Barang : (jpeg,jpg,png)</label>
        <input type="file" name="foto" id="foto" >
        <small>Maksimal 2MB</small>
    </div>
</div>

<div class="modal-footer">
  <button type="reset" class="btn btn-default" data-dismiss="modal">Batal</button>
  <button type="submit" id="data" class="btn btn-primary">Tambah</button>
</div>

</form>
</div>
</div>
</div>

<div class="modal fade" id="edit-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Data Barang</h4>
    </div>
    <form method="POST" enctype="multipart/form-data" id="form-edit">
      @csrf
        <div class="modal-body">
        <div class="form-group" style="width: 100%;">
            <label for="nama" class="control-label">Nama :</label>
            <input type="text" name="nama" id="edit-nama" class="form-control" placeholder="Nama Barang" style="width: 100%;"
            required>
        </div>
        <div class="form-group" style="width: 100%;">
            <label for="kondisi" class="control-label">Kondisi :</label>
            <select name="kondisi" id="edit-kondisi" class="form-control" required>
              <option value="" disabled selected>-- kondisi barang --</option>
              <option value="Layak Pakai" >Layak Pakai</option>
              <option value="Tidak Layak Pakai">Tidak Layak Pakai</option>
          </select>
      </div>
      <div class="form-group" style="width: 100%;">
        <label for="jumlah" class="control-label">Jumlah :</label>
        <input type="text" id="edit-jumlah" name="jumlah" class="form-control" placeholder="Jumlah Barang" maxlength="13"
        style="width: 100%;" value="" required>
    </div>
    <div class="form-group" style="width: 100%;">
        <label for="stok" class="control-label">Stok :</label>
        <input type="text" name="stok" id="edit-stok"  class="form-control" placeholder="Stok Barang Yang Ada Sekarang"
        style="width: 100%;" required>
    </div>
    <span id="old-foto"></span>
    <div class="form-group" style="width: 100%;">
      
        <label for="stok" class="control-label">Masukkan Foto Barang : (jpeg,jpg,png)</label>
        <input type="file" id="edit-foto" name="foto">
        <small>Maksimal 2MB</small>
    </div>
</div>
<input type="hidden" name="hiddenid" id="hidden-id">
<input name="_method" type="hidden" value="PUT">
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
  <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</div>
</form>
</div>
</div>
</div>
</div>
@endsection

@section('js')
  <script type="text/javascript">

    function hapus(jabatan) {
      if(jabatan == 'kord_tools' || jabatan == 'staff_tools' ) {
         hapus_data();
      } else {
          wrong_role('Hanya Divisi Tools And Properties');
      }
    }

  function cek(jabatan) {
   if(jabatan == 'kord_tools' || jabatan == 'staff_tools' ) {
    $('#confirm-add').modal('show');
   } else {
    wrong_role('Hanya Divisi Tools And Properties');
   }
 }

 function edit(jabatan){
  if (jabatan == 'kord_tools' || jabatan == 'staff_tools') {
      $(document).on('click', '#edit-item', function(){
        var id = $(this).attr('data-id');
        $.ajax({
          'url': "data-barang/"+id+"/edit",
          'dataType': 'json',
          success:function(html){
            $('#edit-nama').val(html.data.nama);
            $('#edit-jumlah').val(html.data.jumlah);
            $('#edit-stok').val(html.data.stok);
            $('#edit-kondisi').val(html.data.kondisi);
            $('#hidden-id').val(html.data.id);
            $('#old-foto').html("<img src='storage/"+html.data.foto+"' width='90px'>");
            $('#edit-data').modal('show');
          }
        })
      });
  } else {
    wrong_role('Hanya Divisi Tools And Properties');
  }
 }
 
  $('#insertdata').submit(function(e){
    e.preventDefault();
    var jumlah  = eval(document.getElementById('jumlah').value);
    var stok    = eval(document.getElementById('stok').value);
    if (stok > jumlah) {
      return gagal('Stok', 'lebih banyak dari jumlah');
    }
    
    var request = new FormData(this);
    var endpoint= '{{ route("data-barang.store") }}';
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
             
              berhasil(data.status, data.pesan);
              // tablebarang();
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



    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

  $('#form-edit').submit(function(e){
    e.preventDefault();
    var jumlah  = eval(document.getElementById('edit-jumlah').value);
    var stok    = eval(document.getElementById('edit-stok').value);
    if (stok > jumlah) {
      return gagal('Stok', 'lebih banyak dari jumlah');
    }
    // var id = $('#hidden-id').val();
var id  = eval(document.getElementById('hidden-id').value);

    // console.log(id);
    var request = new FormData(this);
    var endpoint= "data-barang/"+id;
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
             
              berhasil(data.status, data.pesan);
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
});



    </script>

    <script>
      var tabel = null;
      var no = 1;
 tabel = $(document).ready(function(){
    $('#table').DataTable({
        // "processing": true,
        "serverSide": true,
        "deferRender": true,
        "ordering": true,
        "order": [[ 0, 'asc' ]],
        "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]],
        "ajax":  {
                "url":  '{{route("tablebarang")}}', // URL file untuk proses select datanya
                "type": "GET"
              },
        "columns": [
            { "data": "DT_RowIndex" },
            { "data": "nama" },
            { "data": "kondisi" },
            { "data": "jumlah" },
            { "data": "stok" },
            { "data": "created_at" },
            { "data": "foto" },
            { "data": "namaadmin" },
            { "data": "action" }
        ]
    });
});

 
</script>
@endsection
