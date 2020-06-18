<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class User extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware(['auth', 'verified']);
    }
    
    public function index()
    {
        // $data = \App\
      //   $type = DB::select(DB::raw("SHOW COLUMNS FROM users WHERE Field = 'jabatan'"))[0]->Type ;
 
      // preg_match('/^enum\((.*)\)$/', $type, $matches);
 
      // $enum_values = array();
      // foreach( explode(',', $matches[1]) as $value )
      // {
      //   $v = trim( $value, "'" );
      //   $enum_values = array_add($enum_values, $v, $v);
      // }
      // return $enum_values;
        return view('persuratan.user');    
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

    public function api_test() {
      return $array = array('status' => 'success' , 'pesan' => 'Berhasil' ); 
    }
    public function tableuser()
    {
      // return $array = array('status' => 'success' , 'pesan' => 'Berhasil' );
        $data = \App\User::get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($data) {
            $role = \Auth::user()->jabatan;
            $edit_cek  = 'cek_edit("'.$role.'")';
            $hapus_cek = 'hapus_cek("'.$role.'")';
        return "<button class='btn btn-success btn-xs' title='Edit Data' id='edit-item' 
                data-id='".$data->id."' onclick='".$edit_cek."' >
                    <i class='fa fa-pencil'></i>
                </button>

                <button class='btn btn-danger btn-xs' title='Hapus Data' id='del_user'
                href='user/".$data->id."' onclick='".$hapus_cek."'>
                    <i class='fa fa-trash'></i>
                </button>";
        })
        ->editColumn('foto', function ($data) {
          return '<a href="storage/'.$data->foto.'" id="fancy" > 
                    <img src="storage/'.$data->foto.'"  width="70px" data-fancybox alt="'.$data->name.'"> 
                    </a>'
                     ;
        })
        ->rawColumns(['action', 'foto'])
        ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $this->validate($request, [
            'noreg'     => 'required|unique:users|min:14|max:14',
            'phone'     => 'required|unique:users|min:12|max:14',
            'password'  => 'required|string|min:6',
            'email'     => 'required|unique:users|max:255',
            'status_surat'     => 'required|max:255',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2042',
        ]);
        $datauser = new \App\User;
        $datauser->name      = $request->name;
        $datauser->email     = $request->email;
        $datauser->jabatan   = $request->jabatan;
        $datauser->phone     = $request->phone;
        $datauser->noreg     = $request->noreg;
        $datauser->status_surat     = $request->status_surat;
        $datauser->password  = Hash::make($request['password']);
        $dokumentasi = $request->file('foto');
        if($dokumentasi) {
            $dokumentasi_path = $dokumentasi->store('anggota', 'public');
            $databarang->foto = $dokumentasi_path;
        }
        $datauser->save();
        return $arrayName = array('status' => 'success' , 'pesan' => 'Berhasil Menambah Data User' );
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
        $data = \App\User::findOrfail($id);
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
        // $validasi = $this->validate($request, [
        //     'noreg'     => 'required|unique:users|min:14|max:14'.$id,
        //     'phone'     => 'required|unique:users|min:12|max:14'.$id,
        //     'status_surat'     => 'required|max:255',
        // ]);

        $datauser = \App\User::findOrfail($id); 

        $validasi = $this->validate($request, [
            'noreg'     => 'required|min:14|max:14|unique:users,noreg,'.$id ,
            'phone'     => 'required|min:12|max:14|unique:users,phone,'.$id ,
            'status_surat'     => 'required|max:255',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2042',
        ]);   
        
        $datauser->name      = $request->name;
        $datauser->jabatan   = $request->jabatan;
        $datauser->phone     = $request->phone;
        $datauser->noreg     = $request->noreg;
        $datauser->status_surat     = $request->status_surat;
        $foto = $request->file('foto');
        if($foto){
            if($datauser->foto && file_exists(storage_path('app/public/' . $datauser->foto))) { 
                \Storage::delete('public/'. $data->foto);
            }
            $foto_path = $foto->store('anggota', 'public');
            $datauser->foto = $foto_path;
        }
        $datauser->save();
        return $arrayName = 
        array (
            'status' => 'success' , 
            'pesan' => 'Berhasil Mengubah Data', 
            'role' => $datauser->jabatan
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aktif = \Auth::user()->id;
        if ($aktif == $id) {
            return $arrayName = array('status' => 'error' , 
                                      'pesan' => 'Tidak Dapat Memproses, Akun ini Sedang Aktif' );
        }

        $data = \App\User::findOrfail($id);
        \Storage::delete('public/'. $data->foto);
        $data->delete();
            return $arrayName = array('status' => 'success' , 
                                      'pesan' => 'Berhasil Menghapus Data' );
    }
}
