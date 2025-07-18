@extends('layout.app')

@section('title', 'Dashboard Operator')

@section('content')
    <h2>Selamat Datang, {{ Auth::user()->name }}</h2>
    <p>Ini adalah halaman dashboard operator.</p>
@endsection
