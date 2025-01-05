<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\PesertaRepositoryInterface;
use App\Repositories\PesertaRepository;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $pesertaRepository;

    public function __construct(PesertaRepositoryInterface $pesertaRepository)
    {
        $this->pesertaRepository = $pesertaRepository;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email_peserta' => 'required|email',
            'password' => 'required',
        ]);

        $peserta = $this->pesertaRepository->authenticate($request->email_peserta, $request->password);

        if ($peserta) {
            session(['peserta' => $peserta]);

            return redirect()->route('peserta.index');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function logout()
    {
        session()->forget('peserta');
        return redirect()->route('login');
    }
}
