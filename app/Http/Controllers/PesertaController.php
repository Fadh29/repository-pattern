<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PesertaRepositoryInterface;
use App\Repositories\Contracts\JurusanRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    protected $pesertaRepository;
    protected $jurusanRepository;

    public function __construct(
        PesertaRepositoryInterface $pesertaRepository,
        JurusanRepositoryInterface $jurusanRepository
    ) {
        $this->pesertaRepository = $pesertaRepository;
        $this->jurusanRepository = $jurusanRepository;
    }

    public function index()
    {
        $peserta = $this->pesertaRepository->getAll();
        return response()->json(['success' => true, 'data' => $peserta]);
    }

    public function create()
    {
        $jurusan = $this->jurusanRepository->getAll();
        return response()->json(['success' => true, 'data' => $jurusan]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_peserta' => 'required|string',
            'jenis_kelamin_peserta' => 'required|in:L,P',
            'alamat_peserta' => 'required|string',
            'email_peserta' => 'required|email|unique:peserta,email_peserta',
            'password' => 'required|string',
            'id_jurusan' => 'required|array',
            'id_jurusan.*' => 'exists:jurusan,id_jurusan',
        ]);

        $peserta = $this->pesertaRepository->create([
            'nama_peserta' => $request->nama_peserta,
            'jenis_kelamin_peserta' => $request->jenis_kelamin_peserta,
            'alamat_peserta' => $request->alamat_peserta,
            'email_peserta' => $request->email_peserta,
            'password' => bcrypt($request->password),
        ]);

        $peserta->jurusan()->attach($request->id_jurusan);

        return response()->json(['success' => true, 'message' => 'Peserta berhasil ditambahkan.']);
    }

    public function edit($id)
    {
        $peserta = $this->pesertaRepository->getById($id);
        $jurusan = $this->jurusanRepository->getAll();

        if (!$peserta) {
            return response()->json(['success' => false, 'message' => 'Peserta tidak ditemukan.'], 404);
        }

        return response()->json(['success' => true, 'data' => compact('peserta', 'jurusan')]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_peserta' => 'required|string',
            'alamat_peserta' => 'required|string',
            'id_jurusan' => 'required|array',
            'id_jurusan.*' => 'exists:jurusan,id_jurusan',
        ]);

        $peserta = $this->pesertaRepository->getById($id);

        if (!$peserta) {
            return response()->json(['success' => false, 'message' => 'Peserta tidak ditemukan.'], 404);
        }

        $peserta->update([
            'nama_peserta' => $request->nama_peserta,
            'alamat_peserta' => $request->alamat_peserta,
        ]);

        $peserta->jurusan()->sync($request->id_jurusan);

        return response()->json(['success' => true, 'message' => 'Peserta berhasil diperbarui.']);
    }

    public function destroy($id)
    {
        $peserta = $this->pesertaRepository->getById($id);

        if (!$peserta) {
            return response()->json(['success' => false, 'message' => 'Peserta tidak ditemukan.'], 404);
        }

        $peserta->jurusan()->detach();
        $this->pesertaRepository->delete($id);

        return response()->json(['success' => true, 'message' => 'Peserta berhasil dihapus.']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email_peserta' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email_peserta', 'password');
        $token = $this->pesertaRepository->authenticate($credentials['email_peserta'], $credentials['password']);

        if ($token) {
            return response()->json([
                'success' => true,
                'message' => 'Login berhasil.',
                'token' => $token,
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Email atau password salah.'], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['success' => true, 'message' => 'Berhasil logout.']);
    }
}
