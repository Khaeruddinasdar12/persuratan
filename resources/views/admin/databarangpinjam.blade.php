@extends('layouts.template')

@section('title') Riwayat peminjaman @endsection

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
              <h2>Data Barang Yang Pernah Di Pinjam</h2>

              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <table id="table" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No. </th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Peminjam</th>
                    <th>Foto Barang</th>
                    <th>Created_by</th>
                    <th>Accepted_by</th>
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
              <form action="#" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group" style="width: 100%;">
                    <label for="kodbar" class="control-label" style="padding-top: 10px;">Kode Barang
                      :</label>
                    <input type="text" name="kodbar" class="form-control" placeholder="Masukkan Kode Barang"
                      style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="nama" class="control-label">Nama :</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Barang"
                      style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="kondisi" class="control-label">Kondisi :</label>
                    <select name="kondisi" class="form-control" required>
                      <option value="" disabled selected>-- kondisi barang --</option>
                      <option value="Layak Pakai">Layak Pakai</option>
                      <option value="Tidak Layak Pakai">Tidak Layak Pakai</option>
                    </select>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="jumlah" class="control-label">Jumlah :</label>
                    <input type="text" name="jumlah" class="form-control" placeholder="Jumlah Barang" maxlength="13"
                      style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="stok" class="control-label">Stok :</label>
                    <input type="text" name="stok" class="form-control" placeholder="Stok Barang Yang Ada Sekarang"
                      style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="stok" class="control-label">Masukkan Foto Barang :</label>
                    <input type="file">
                    <small>Maksimal 2MB</small>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Tambah</a>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal fade" id="confirm-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
          aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Edit Data Barang</h4>
              </div>
              <form action="#" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group" style="width: 100%;">
                    <label for="kodbar" class="control-label" style="padding-top: 10px;">Kode Barang
                      :</label>
                    <input readonly="readonly" type="text" name="kodbar" class="form-control" placeholder="Kode Barang"
                      style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="nama" class="control-label">Nama :</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama Barang" style="width: 100%;"
                      required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="kondisi" class="control-label">Kondisi :</label>
                    <select name="kondisi" class="form-control" required>
                      <option value="" disabled selected>-- kondisi barang --</option>
                      <option value="Layak Pakai">Layak Pakai</option>
                      <option value="Tidak Layak Pakai">Tidak Layak Pakai</option>
                    </select>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="jumlah" class="control-label">Jumlah :</label>
                    <input type="text" name="jumlah" class="form-control" placeholder="Jumlah Barang" maxlength="13"
                      style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="stok" class="control-label">Stok :</label>
                    <input type="text" name="stok" class="form-control" placeholder="Stok Barang Yang Ada Sekarang"
                      style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="stok" class="control-label">Masukkan Foto Barang :</label>
                    <input type="file">
                    <small>Maksimal 2MB</small>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Simpan Perubahan</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

@endsection

@section('js')
    <script type="text/javascript">
        function hapus_cek(jabatan) {
  if(jabatan != 'kord_tools') {
    wrong_role('Hanya Koordinator Tools And Properties');
   } else {
    $(document).on('click', '#del_pernah_pinjam', function(){
      // e.preventDefault();
      // $('#edit-user')[0].reset();
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
                "url":  '{{route("tablepernahpinjam")}}', // URL file untuk proses select datanya
                "type": "GET"
              },
        "columns": [
            { "data": "DT_RowIndex" },
            { "data": "kode_barang" },
            { "data": "nama" },
            { "data": "jumlah" },
            { "data": "created_at" },
            { "data": "tanggal_kembali" },
            { "data": "peminjam" },
            { "data": "foto" },
            { "data": "namaadmin" },
            { "data": "accepted_by" },
            { "data": "action" }
        ]
    });
});
      </script>  
@endsection