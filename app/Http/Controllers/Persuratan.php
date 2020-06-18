<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class Persuratan extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
         $this->middleware(['auth', 'verified']);
    }
    public function index()
    {
        return view('persuratan.persuratan');
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $validasi = $this->validate($request, [
            'foto' => 'image|mimes:jpeg,png,jpg|max:3072'
        ]);
        
        $data = new \App\Persuratan;
        $data->no_surat         = $request->no_surat;
        $data->judul            = $request->judul;
        $data->dari_kepada      = $request->dari_kepada;
        $data->tanggal          = $request->tanggal;
        $data->jenis_surat      = $request->jenis_surat;
        $data->created_by       = \Auth::user()->id;
        // return $arrayName = 
        //             array(
        //                 'no_surat' => $request->no_surat,
        //                 'judul' => $request->judul,
        //                 'dari_kepada' => $request->dari_kepada,
        //                 'tanggal' => $request->tanggal,
        //                 '$data' => $request->jenis_surat,
        //                 'created_by' => \Auth::user()->id
        //             );

        $dokumentasi = $request->file('foto');
        if($dokumentasi) {
            $dokumentasi_path = $dokumentasi->store('persuratan', 'public');
            $data->foto = $dokumentasi_path;
        }
        $data->save();

        return $arrayName = 
                array(
                    'status' => 'success' , 
                    'pesan' => 'Berhasil Menambah Data', 
                    'surat' => $data->jenis_surat 
                ); 
    }

    public function surat_masuk() 
    {
        $data = DB::table('persuratans')
                ->join('users', 'users.id', '=', 'persuratans.created_by')
                ->select('users.name as namaadmin', 'persuratans.*')
                ->where('jenis_surat', '=', 'surat_masuk')
                ->get();

        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($data) {
            $role = \Auth::user()->jabatan;
            $hapus  = 'hapus("'.$role.'", "#table_surat_masuk")';
            $edit  = 'edit("'.$role.'")';
        return "<button class='btn btn-success btn-xs' title='Edit Data' id='edit-item' 
                    data-id='".$data->id."' onclick='".$edit."'>
                    <i class='fa fa-pencil'></i>
                </button>

                <button class='btn btn-danger btn-xs' title='Hapus Data' id='del_id' 
                    href='persuratan/".$data->id."' onclick='".$hapus."'>
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

    public function surat_keluar() 
    {
        $data = DB::table('persuratans')
                ->join('users', 'users.id', '=', 'persuratans.created_by')
                ->select('users.name as namaadmin', 'persuratans.*')
                ->where('jenis_surat', '=', 'surat_keluar')
                ->get();
                
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($data) {
            $role = \Auth::user()->jabatan;
            $hapus  = 'hapus("'.$role.'", "#table_surat_keluar")';
            $edit  = 'edit("'.$role.'")';
        return "<button class='btn btn-success btn-xs'title='Edit Data' id='edit-item' 
                    data-id='".$data->id."' onclick='".$edit."'>
                    <i class='fa fa-pencil'></i>
                </button>

                <button class='btn btn-danger btn-xs' title='Hapus Data' id='del_id' 
                    href='persuratan/".$data->id."' onclick='".$hapus."'>
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

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $data = \App\Persuratan::findOrfail($id);
        return response()->json(['data' => $data]);
    }

    public function update(Request $request)
    {
        $validasi = $this->validate($request, [
            'foto' => 'image|mimes:jpeg,png,jpg|max:3072'
        ]);
        $id = $request->hiddenid;
        $data = \App\Persuratan::findOrfail($id);
        $jenis_surat_now    = $data->jenis_surat;
        $jenis_surat_request= $request->jenis_surat;
        $data->no_surat         = $request->no_surat;
        $data->judul            = $request->judul;
        $data->dari_kepada      = $request->dari_kepada;
        $data->tanggal          = $request->tanggal;
        $data->jenis_surat      = $request->jenis_surat;
        $foto = $request->file('foto');
        if($foto){
            if($data->foto && file_exists(storage_path('app/public/' . $data->foto))) { 
                \Storage::delete('public/'. $data->foto);
            }
            $foto_path = $foto->store('persuratan', 'public');
            $data->foto = $foto_path;
        }
        $data->save();

        if ($jenis_surat_now != $jenis_surat_request) {
            $reload_tabel = 'reload_all_table';
        } else {
            $reload_tabel = $request->jenis_surat;
        }
        return $arrayName = 
                array(
                    'status'=> 'success' , 
                    'pesan' => 'Berhasil Menambah Data', 
                    'surat' => $data->jenis_surat,
                    'reload'=> $reload_tabel
                );
        
    }

    public function destroy($id)
    {
        $data = \App\Persuratan::findOrfail($id);
            \Storage::delete('public/'. $data->foto);
        $data->delete();
            return $arrayName = array('status' => 'success' , 'pesan' => 'Berhasil Menghapus Data' );
    }
}
