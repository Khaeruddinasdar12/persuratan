<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
class Perpustakaan extends Controller
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

        return view('admin.perpustakaan');
    }

    public function tableperpustakaan()
    {
        $data = DB::table('perpustakaans')
                ->join('users', 'users.id', '=', 'perpustakaans.created_by')
                ->select('users.name as namaadmin', 'perpustakaans.*')
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
                    href='perpustakaan/".$data->id."' onclick='".$hapus."'>
                    <i class='fa fa-trash'></i>
                </button>";
        })
        ->rawColumns(['foto','action'])
        ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        DB::statement("ALTER TABLE perpustakaans AUTO_INCREMENT = 1;"); 

        $perpustakaan = new \App\Perpustakaan;
        $perpustakaan->judul        = $request->judul;
        $perpustakaan->konsentrasi  = $request->konsentrasi;
        $perpustakaan->tipe  = $request->tipe;
        $perpustakaan->created_by   = \Auth::user()->id;
        $perpustakaan->save();

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
        $data = \App\Perpustakaan::findOrfail($id);
        return response()->json(['data' => $data]);
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
        $data = \App\Perpustakaan::findOrfail($id);
        $data->delete();
        return $arrayName = array('status' => 'success' , 'pesan' => 'Berhasil Menghapus Data' );
    }
}
