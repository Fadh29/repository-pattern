<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\JurusanRepositoryInterface;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    protected $jurusanRepository;

    public function __construct(JurusanRepositoryInterface $jurusanRepository)
    {
        $this->jurusanRepository = $jurusanRepository;
    }

    public function index()
    {
        $jurusan = $this->jurusanRepository->getAll();
        return view('jurusan.index', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_jurusan' => 'required|string|max:255',
        ]);

        $this->jurusanRepository->create($data);
        return redirect()->back()->with('success', 'Jurusan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama_jurusan' => 'required|string|max:255',
        ]);

        $result = $this->jurusanRepository->update($id, $data);

        if ($result) {
            return redirect()->back()->with('success', 'Jurusan berhasil diperbarui!');
        }

        return redirect()->back()->with('error', 'Jurusan tidak ditemukan!');
    }

    public function destroy($id)
    {
        $result = $this->jurusanRepository->delete($id);

        if ($result) {
            return redirect()->back()->with('success', 'Jurusan berhasil dihapus!');
        }

        return redirect()->back()->with('error', 'Jurusan tidak ditemukan!');
    }
}
