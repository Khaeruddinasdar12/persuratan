@extends('layouts.template')

@section('title') Data perpustakaan @endsection

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
      <h2>Data Perpustakaan</h2>

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
            <th>Judul Buku</th>
            <th>Konsentrasi</th>
            <th>Tipe</th>
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
        <h4 class="modal-title">Tambah Data Perpustakaan</h4>
    </div>
    <form id="insertdata" method="POST" >
        @csrf
        <div class="modal-body">  
          <div class="form-group" style="width: 100%;">
            <label for="nama" class="control-label">Judul Buku :</label>
            <input type="text" name="judul" id="judul" class="form-control" placeholder="judul buku"
            style="width: 100%;" required>
        </div>
      <div class="form-group" style="width: 100%;">
        <label for="jumlah" class="control-label">Konsentrasi :</label>
        <input type="text" name="konsentrasi" class="form-control" placeholder="konsentrasi"
        style="width: 100%;" required>
    </div>
    <div class="form-group" style="width: 100%;">
        <label for="stok" class="control-label">Tipe :</label>
        <input type="text" name="tipe" class="form-control" placeholder="tipe"
        style="width: 100%;" required>
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
        <h4 class="modal-title">Edit Data Perpustakaan</h4>
    </div>
    <form method="POST" enctype="multipart/form-data" id="form-edit">
      @csrf
        <div class="modal-body">
        <div class="form-group" style="width: 100%;">
            <label for="nama" class="control-label">Judul Buku :</label>
            <input type="text" name="nama" id="edit-nama" class="form-control" placeholder="Judul buku" style="width: 100%;"
            required>
        </div>
      <div class="form-group" style="width: 100%;">
        <label for="jumlah" class="control-label">Konsentrasi :</label>
        <input type="text" id="edit-konsentrasi" name="jumlah" class="form-control" placeholder="Konsentrasi" 
        style="width: 100%;" value="" required>
    </div>
    <div class="form-group" style="width: 100%;">
        <label for="jumlah" class="control-label">Tipe :</label>
        <input type="text" id="edit-tipe" name="jumlah" class="form-control" placeholder="Tipe"
        style="width: 100%;" value="" required>
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
          'url': "perpustakaan/"+id+"/edit",
          'dataType': 'json',
          success:function(html){
            $('#edit-nama').val(html.data.judul);
            $('#edit-konsentrasi').val(html.data.konsentrasi);
            $('#edit-tipe').val(html.data.tipe);
            $('#hidden-id').val(html.data.id); 
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
    var request = new FormData(this);
    var endpoint= '{{ route("perpustakaan.store") }}';
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
   tabel = $(document).ready(function(){
    $('#table').DataTable({
        // "processing": true,
        "serverSide": true,
        "deferRender": true,
        "ordering": true,
        "order": [[ 0, 'asc' ]],
        "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]],
        "ajax":  {
                "url":  '{{route("tableperpustakaan")}}', // URL file untuk proses select datanya
                "type": "GET"
              },
        "columns": [
            { "data": "DT_RowIndex" },
            { "data": "judul" },
            { "data": "konsentrasi" },
            { "data": "tipe" },
            { "data": "namaadmin" },
            { "data": "action" }
        ]
    });
    });
</script>
@endsection
