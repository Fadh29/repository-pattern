<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PesertaRepositoryInterface;
use App\Repositories\Contracts\JurusanRepositoryInterface;
use App\Models\Peserta;
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
        return view('peserta.index', compact('peserta'));
    }

    public function create()
    {
        $jurusan = $this->jurusanRepository->getAll();
        return view('peserta.create', compact('jurusan'));
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

        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $peserta = $this->pesertaRepository->getById($id);
        $jurusan = \App\Models\Jurusan::all();
        return view('peserta.edit', compact('peserta', 'jurusan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_peserta' => 'required|string',
            'alamat_peserta' => 'required|string',
            'id_jurusan' => 'required|array',
            'id_jurusan.*' => 'exists:jurusan,id_jurusan',
        ]);

        $peserta = Peserta::findOrFail($id);
        $peserta->update([
            'nama_peserta' => $request->nama_peserta,
            'alamat_peserta' => $request->alamat_peserta,
        ]);

        $peserta->jurusan()->sync($request->id_jurusan);

        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $peserta = $this->pesertaRepository->getById($id);

        if (!$peserta) {
            return redirect()->route('peserta.index')->with('error', 'Peserta tidak ditemukan.');
        }

        $peserta->jurusan()->detach();
        $this->pesertaRepository->delete($id);

        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil dihapus.');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email_peserta', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Berhasil login!');
        }

        return back()->withErrors([
            'email_peserta' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout!');
    }
}
