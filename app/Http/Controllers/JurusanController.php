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

    // API: Get all jurusan
    public function index()
    {
        $jurusan = $this->jurusanRepository->getAll();
        return response()->json([
            'success' => true,
            'data' => $jurusan
        ]);
    }

    // API: Create a new jurusan
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_jurusan' => 'required|string|max:255',
        ]);

        $jurusan = $this->jurusanRepository->create($data);

        return response()->json([
            'success' => true,
            'message' => 'Jurusan berhasil ditambahkan!',
            'data' => $jurusan
        ], 201);  // Status 201 Created
    }

    // API: Update an existing jurusan
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama_jurusan' => 'required|string|max:255',
        ]);

        $result = $this->jurusanRepository->update($id, $data);

        // Cek apakah update berhasil
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Jurusan berhasil diperbarui!',
                'data' => $result
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Jurusan tidak ditemukan!'
        ], 404);
    }


    // API: Delete a jurusan
    public function destroy($id)
    {
        $result = $this->jurusanRepository->delete($id);

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Jurusan berhasil dihapus!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Jurusan tidak ditemukan!'
        ], 404);  // Status 404 Not Found
    }
}
