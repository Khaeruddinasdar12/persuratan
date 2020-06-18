<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DataTables;
use Illuminate\Support\Facades\DB;
class DataBarang extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
         $this->middleware(['auth', 'verified']);
    }
    
    public function index()
    {
        return view('admin.databarang');
    }

    public function tablebarang()
    {
        $data = DB::table('databarangs')
                ->join('users', 'users.id', '=', 'databarangs.created_by')
                ->select('users.name as namaadmin', 'databarangs.*')
                ->get();
                
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($data) {
            $role = \Auth::user()->jabatan;
            $hapus  = 'hapus("'.$role.'")';
            $edit  = 'edit("'.$role.'")';
        return "<button class='btn btn-success btn-xs'title='Edit Data' id='edit-item' 
                    data-id='".$data->id."' onclick='".$edit."'>
                    <i class='fa fa-pencil'></i>
                </button>

                <button class='btn btn-danger btn-xs' title='Hapus Data' id='del_id' 
                    href='data-barang/".$data->id."' onclick='".$hapus."'>
                    <i class='fa fa-trash'></i>
                </button>";
        })
        ->editColumn('foto', function ($data) {
          return '<a href="storage/'.$data->foto.'" id="fancy" > 
                    <img src="storage/'.$data->foto.'"  width="70px" data-fancybox> 
                    </a>'
                     ;
        })
        ->rawColumns(['foto','action'])
        ->make(true);
    }

    public function create()
    {
        //
    }

    public function cekstok($id)
    {
        $cek = \App\Databarang::where('id', '=', $id)->pluck('stok')->first();
        // return $cek;
        return $arrayName = array('stok' => $cek); 
        // $data = \App\Databarang::findOrfail($id);
    }

    public function store(Request $request)
    {
        $validasi = $this->validate($request, [
            'foto' => 'image|mimes:jpeg,png,jpg|max:3072',
            'jumlah' => 'numeric|min:1',
            'stok' => 'numeric|min:1'
        ]);
        
        $databarang = new \App\Databarang;
        $databarang->nama       = $request->nama;
        $databarang->kondisi    = $request->kondisi;
        $databarang->jumlah     = $request->jumlah;
        if($request->stok > $request->jumlah) {
            return $arrayName = array('status' => 'error' , 'pesan' => 'Stok lebih banyak dari jumlah' );
        }
        $databarang->stok     = $request->stok;
        $databarang->created_by = \Auth::user()->id;

        $dokumentasi = $request->file('foto');
        if($dokumentasi) {
            $dokumentasi_path = $dokumentasi->store('inventaris', 'public');
            $databarang->foto = $dokumentasi_path;
        }
        $databarang->save();
        // echo json_encode($databarang);
        return $arrayName = array('status' => 'success' , 'pesan' => 'Berhasil Menambah Data' );   
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = \App\Databarang::findOrfail($id);
        return response()->json(['data' => $data]);
    }

    public function update(Request $request)
    {
        $validasi = $this->validate($request, [
            'foto' => 'image|mimes:jpeg,png,jpg|max:3072',
            'jumlah' => 'numeric|min:1',
            'stok' => 'numeric|min:1'
        ]);
        $id = $request->hiddenid;
        $data = \App\Databarang::findOrfail($id);
        $data->nama     = $request->nama;
        $data->kondisi  = $request->kondisi;
        $data->jumlah   = $request->jumlah;
        $data->stok     = $request->stok;
         $foto = $request->file('foto');
        if($foto){
            if($data->foto && file_exists(storage_path('app/public/' . $data->foto))) { 
                \Storage::delete('public/'. $data->foto);
            }
            $foto_path = $foto->store('inventaris', 'public');
            $data->foto = $foto_path;
        }
        $data->save();
        return $arrayName = array('status' => 'success' , 'pesan' => 'Berhasil Mengubah Data' );

    }


    public function destroy($id)
    {
        $cek = DB::table('peminjamans')->where('kode_barang', $id)->get()->count();
        if ($cek >= '1') {
            return $arrayName = array('status' => 'error' , 'pesan' => 'Barang ini sedang dipinjam' );
        }

        $data = \App\Databarang::findOrfail($id);
            \Storage::delete('public/'. $data->foto);
        $data->delete();
            return $arrayName = array('status' => 'success' , 'pesan' => 'Berhasil Menghapus Data' );
       
    }
}
