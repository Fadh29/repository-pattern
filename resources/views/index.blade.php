@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Selamat Datang!</h1>
        <p>Pilih menu di bawah ini:</p>

        <ul>
            <li><a href="{{ route('peserta.index') }}">Peserta</a></li>
            <li><a href="{{ route('jurusan.index') }}">Jurusan</a></li>
            <li><a href="{{ route('weather.index') }}">Weather</a></li>
        </ul>

        <form action="{{ route('logout') }}" method="POST" style="margin-top: 20px;">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
@endsection
