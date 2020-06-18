@extends('layouts.template')

@section('title') Dashboard @endsection

@section('content')
		<!-- home -->
		<div class="text-center">
			<img src="{{ asset('letter-logos.png') }}" alt="Persuratan" class="logos">
		</div>
		<br>
		<div id="sidebar-menu" class="text-center main_menu_side hidden-print main_menu">
			<div class="menu_section ">
				<h3 style="color: black !important">SELAMAT DATANG {{ Auth::user()->name }}</h4>
			</div>
		</div>
		<!-- akhir home -->

		<!-- barang -->
		
		<!-- akhir barang -->
@endsection