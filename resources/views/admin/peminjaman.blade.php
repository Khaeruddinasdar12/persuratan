@extends('layouts.template')
@section('title') Peminjaman @endsection 

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
              <h2>Peminjaman Barang</h2>

              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="text-center">
                <button onclick="cek(jabatan)" class="btn btn-primary tombol">
                  <i class="fa fa-plus"></i> Tambah data</button>
              </div>
              <table id="table" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No. </th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Peminjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Jumlah Barang Yang Di Pinjam</th>
                    <th>Kondisi</th>
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
              <form id="input_peminjaman" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                  <div class="form-group" style="width: 100%;">
                    <label for="kondisi" class="control-label">Pilih Barang Yang Akan Di Pinjamkan</label>
                    <select name="kode_barang" class="form-control" id="kdbarang" onchange="stok()" required>
                      <option value="" disabled selected>-- daftar barang --</option>
                      @foreach($data as $datas)
                        <option value="{{$datas->id}}">{{$datas->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="nama" class="control-label">Stok :</label>
                    <input type="text" id="jmlstok" class="form-control" disabled 
                      style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="nama" class="control-label">Nama Peminjam :</label>
                    <input type="text" name="peminjam" class="form-control" placeholder="Masukkan Nama Peminjam"
                      style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="jumlah" class="control-label">Jumlah Barang Yang Dipinjam :</label>
                    <input type="text" name="jumlah" class="form-control" placeholder="Jumlah Barang" maxlength="13"
                      style="width: 100%;" required>
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
        <div class="modal fade" id="confirm-balik" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
          aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Kembalikan Barang</h4>
              </div>
              <form id="kembalikan_barang" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                  <div class="form-group" style="width: 100%;">
                    <label for="nama" class="control-label">Nama Peminjam :</label>
                    <input type="text" name="nama" id="balik-peminjam" class="form-control" style="width: 100%;"
                      readonly="readonly" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="nama" class="control-label">Nama Barang :</label>
                    <input type="text" name="nama" id="balik-nama" class="form-control" style="width: 100%;"
                      readonly="readonly" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="kondisi" class="control-label">Kondisi Barang Saat Dikembalikan</label>
                    <select name="kondisi" id="balik-kondisi" class="form-control" required>
                      <option value="" disabled selected>-- kondisi barang --</option>
                      <option value="Layak Pakai"> Layak Pakai </option>
                      <option value="Tidak Layak Pakai"> Tidak Layal Pakai </option>
                    </select>
                  </div>
                </div>
                <input type="hidden" name="hiddenid" id="hidden-id">
                <input name="_method" type="hidden" value="PUT">
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Kembalikan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

@endsection

@section('js')
  
<script type="text/javascript">

  function cek(jabatan) {
   if(jabatan == 'kord_tools' || jabatan == 'staff_tools' ) {
    $('#confirm-add').modal('show');
   } else {
    wrong_role('Hanya Divisi Tools And Properties');
    
   }
 }
 
  function stok() {
    // var tes = document.getElementById("kdbarang").value;
    var id = $('#kdbarang').val();
    console.log(id);
    $.ajax({
      'url': "cekstok/"+id,
      'dataType': 'json',
      success:function(data){
        console.log(data);
        $('#jmlstok').val(data.stok);
      }

    })
  }

    $('#input_peminjaman').submit(function(e){
    e.preventDefault();
    var request = new FormData(this);
    // var endpoint= '{{ route("data-barang.store") }}';
    var endpoint= '{{ route("peminjaman.store") }}';
          $.ajax({
            url: endpoint,
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            // dataType: "json",
            success:function(data){
              if(data.status == 'success') {
                $('#input_peminjaman')[0].reset();
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

var tabel = null;
var no = 1;
 tabel = $(document).ready(function(){
    $('#table').DataTable({
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "ordering": true,
        "order": [[ 0, 'asc' ]],
        "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]],
        "ajax":  {
                "url":  '{{route("tablepeminjaman")}}', // URL file untuk proses select datanya
                "type": "GET"
              },
        "columns": [
            { "data": "DT_RowIndex" },
            { "data": "kode_barang" },
            { "data": "nama" },
            { "data": "peminjam" },
            { "data": "created_at" },
            { "data": "jumlah" },
            { "data": "kondisi" },
            { "data": "foto" },
            { "data": "namaadmin" },
            { "data": "action" }
        ]
    });
});

   $('#kembalikan_barang').submit(function(e){
    e.preventDefault();
    var id  = eval(document.getElementById('hidden-id').value);

    // console.log(id);
    var request = new FormData(this);
    var endpoint= "peminjaman/"+id;
          $.ajax({
            url: endpoint,
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            // dataType: "json",
            success:function(data){
              $('#kembalikan_barang')[0].reset();
              $('#confirm-balik').modal('hide');
             
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

function balik(jabatan) {
  if(jabatan == 'kord_tools' || jabatan == 'staff_tools' ) {
        $(document).on('click', '#balik-item', function(){
            var id = $(this).attr('data-id');
            $.ajax({
              'url': "peminjaman/"+id+"/edit",
              'dataType': 'json',
              success:function(html){
                console.log(html.data);
                $('#hidden-id').val(html.data.id);
                $('#balik-peminjam').val(html.data.peminjam);
                $('#balik-nama').val(html.data.nama);
                $('#balik-kondisi').val(html.data.kondisi);
                $('#confirm-balik').modal('show');
              }

            })
        });
  } else {
    wrong_role('Hanya Divisi Tools And Properties');
  }
}
  

function hapus(jabatan) {
      if(jabatan == 'kord_tools' || jabatan == 'staff_tools' ) {
         hapus_data();
      } else {
          wrong_role('Hanya Divisi Tools And Properties');
      }
    }

</script>
@endsection