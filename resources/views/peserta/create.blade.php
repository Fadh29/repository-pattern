@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tambah Peserta</h1>
        <form action="{{ route('peserta.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_peserta" class="form-label">Nama Peserta</label>
                <input type="text" class="form-control" id="nama_peserta" name="nama_peserta"
                    placeholder="Masukkan Nama Peserta" required>
            </div>

            <div class="mb-3">
                <label for="jenis_kelamin_peserta" class="form-label">Jenis Kelamin</label>
                <div>
                    <label class="form-check-label me-3">
                        <input type="radio" class="form-check-input" name="jenis_kelamin_peserta" value="L" required>
                        Laki-Laki
                    </label>
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="jenis_kelamin_peserta" value="P" required>
                        Perempuan
                    </label>
                </div>
            </div>

            <div class="mb-3">
                <label for="alamat_peserta" class="form-label">Alamat Peserta</label>
                <textarea class="form-control" id="alamat_peserta" name="alamat_peserta" rows="3"
                    placeholder="Masukkan Alamat Peserta" required></textarea>
            </div>

            {{-- <div class="mb-3">
                <label for="email_peserta" class="form-label">Email Peserta</label>
                <input type="email" class="form-control" id="email_peserta" name="email_peserta"
                    placeholder="Masukkan Email Peserta" required>
            </div> --}}

            <div class="mb-3">
                <label for="email_peserta" class="form-label">Email Peserta</label>
                <input type="email" class="form-control @error('email_peserta') is-invalid @enderror" id="email_peserta"
                    name="email_peserta" placeholder="Masukkan Email Peserta" value="{{ old('email_peserta') }}" required>
                @error('email_peserta')
                    <div class="invalid-feedback" style="color: #e74a3b; font-size: 0.875em;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Pilih Jurusan</label>
                <div>
                    @foreach ($jurusan as $jurusan)
                        <label>
                            <input type="checkbox" name="id_jurusan[]" value="{{ $jurusan->id_jurusan }}">
                            {{ $jurusan->nama_jurusan }}
                        </label>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
