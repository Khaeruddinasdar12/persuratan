<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientInformasi extends Controller
{
    public function papaninfo()
    {
    	$foto   = \App\PapanInformasi::where('status', '=', 'foto')->get();
    	$event  = \App\PapanInformasi::where('status', '=', 'event')->get();
    	$perpus   = \App\Perpustakaan::get();
        return view('papaninfo.index', ['foto' => $foto, 'event' => $event, 'perpus' => $perpus]);
    }
}
