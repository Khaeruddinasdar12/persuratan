<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class PapanInformasi extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
         $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.papaninformasi');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function tablepapaninformasi()
    {
        $data = DB::table('papaninformasis')
                ->join('users', 'users.id', '=', 'papaninformasis.created_by')
                ->select('users.name as namaadmin', 'papaninformasis.*')
                ->get();

        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($data) {
            $role = \Auth::user()->jabatan;
            $hapus  = 'hapus("'.$role.'")';
            $edit  = 'edit("'.$role.'")';
        return "<button class='btn btn-danger btn-xs' title='Hapus Data' id='del_id' 
                    href='papan-informasi/".$data->id."' onclick='".$hapus."'>
                    <i class='fa fa-trash'></i>
                </button>";
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->status == 'video') {
            $data = new \App\PapanInformasi;
            $data->status = $request->status;
            if ($request->url_video == '') {
                return $arrayName = array('status' => 'error' , 'pesan' => 'Url video tidak boleh kosong' );  
            }
           $data->content = $request->url_video;
        } else if ($request->status == 'foto') {
            $validasi = $this->validate($request, [
                'foto' => 'image|mimes:jpeg,png,jpg|max:3072'
            ]);
            $data = new \App\PapanInformasi;
            $data->status = $request->status;
            if ($request->foto == '') {
                return $arrayName = array('status' => 'error' , 'pesan' => 'Foto tidak boleh kosong' );  
            }
            $dokumentasi = $request->file('foto');
            if($dokumentasi) {
                $dokumentasi_path = $dokumentasi->store('papaninformasi', 'public');
                $data->content = $dokumentasi_path;
            }
        } else if ($request->status == 'event') {
            $data = new \App\PapanInformasi;
            $data->status = $request->status;
            if ($request->artikel == '') {
                return $arrayName = array('status' => 'error' , 'pesan' => 'Artikel tidak boleh kosong' );  
            }
           $data->content = $request->artikel;
        }
        
        $data->created_by = \Auth::user()->id;
        $data->save();

        return $arrayName = array('status' => 'success' , 'pesan' => 'Berhasil Menambah Data' );  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = \App\PapanInformasi::findOrfail($id);
            \Storage::delete('public/'. $data->url);
        $data->delete();
        return $arrayName = array('status' => 'success' , 'pesan' => 'Berhasil Menghapus Data' );
    }
}
