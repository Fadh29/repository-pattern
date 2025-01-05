@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Peserta</h1>

        <form action="{{ route('peserta.update', $peserta->id_peserta) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_peserta" class="form-label">Nama Peserta</label>
                <input type="text" class="form-control" id="nama_peserta" name="nama_peserta"
                    value="{{ old('nama_peserta', $peserta->nama_peserta) }}" required>
            </div>

            <div class="mb-3">
                <label for="email_peserta" class="form-label">Email Peserta</label>
                <input type="email" class="form-control" id="email_peserta" name="email_peserta"
                    value="{{ old('email_peserta', $peserta->email_peserta) }}" readonly>
            </div>

            <div class="mb-3">
                <label for="alamat_peserta" class="form-label">Alamat Peserta</label>
                <textarea class="form-control" id="alamat_peserta" name="alamat_peserta" required>{{ old('alamat_peserta', $peserta->alamat_peserta) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="id_jurusan" class="form-label">Jurusan</label>
                <div id="id_jurusan">
                    @foreach ($jurusan as $item)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="jurusan_{{ $item->id_jurusan }}"
                                name="id_jurusan[]" value="{{ $item->id_jurusan }}"
                                {{ in_array($item->id_jurusan, $peserta->jurusan->pluck('id_jurusan')->toArray()) ? 'checked' : '' }}>
                            <label class="form-check-label" for="jurusan_{{ $item->id_jurusan }}">
                                {{ $item->nama_jurusan }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('peserta.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>

        <form action="{{ route('peserta.destroy', $peserta->id_peserta) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"
                onclick="return confirm('Yakin ingin menghapus peserta ini?')">Hapus</button>
        </form>
    </div>

    </div>
@endsection
