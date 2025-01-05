<h1>Daftar Jurusan</h1>
<table border="1" cellspacing="0" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Jurusan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jurusan as $item)
        <tr>
            <td>{{ $item->id_jurusan }}</td>
            <td>{{ $item->nama_jurusan }}</td>
            <td>
                <!-- Form Update -->
                <form action="{{ route('jurusan.update', $item->id_jurusan) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PUT')
                    <input type="text" name="nama_jurusan" value="{{ $item->nama_jurusan }}" required>
                    <button type="submit">Update</button>
                </form>

                <!-- Form Delete -->
                <form action="{{ route('jurusan.destroy', $item->id_jurusan) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin menghapus jurusan ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<h2>Tambah Jurusan</h2>
<form action="{{ route('jurusan.store') }}" method="POST">
    @csrf
    <input type="text" name="nama_jurusan" placeholder="Nama Jurusan" required>
    <button type="submit">Simpan</button>
</form>
