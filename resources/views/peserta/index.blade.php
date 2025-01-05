@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Daftar Peserta</h1>

        <a href="{{ route('peserta.store') }}" class="btn btn-primary mb-3">Tambah Peserta</a>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peserta as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_peserta }}</td>
                            <td>{{ $item->email_peserta }}</td>
                            <td>
                                @foreach ($item->jurusan as $jurusan)
                                    {{ $jurusan->nama_jurusan }}@if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('peserta.edit', $item->id_peserta) }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('peserta.destroy', $item->id_peserta) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Hapus peserta ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
