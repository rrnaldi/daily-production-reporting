{{-- resources/views/landing.blade.php --}}
@extends('layout.app') {{-- atau bisa gunakan layout custom kamu --}}
@section('title', 'Selamat Datang')
@section('content')
    <div class="text-center mt-5">
        <h1>Selamat Datang di Sistem Produksi</h1>
        <p>Silakan login untuk melanjutkan</p>
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
    </div>
@endsection
