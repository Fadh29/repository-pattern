<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Repositories\Contracts\PesertaRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
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

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email_peserta' => 'required|email',
    //         'password' => 'required|min:6',
    //     ]);

    //     $peserta = $this->pesertaRepository->getByEmail($request->email_peserta);

    //     if ($peserta && Hash::check($request->password, $peserta->password)) {
    //         Session::put('peserta_logged_in', $peserta->id_peserta);
    //         return redirect()->route('dashboard');
    //     }

    //     return back()->withErrors(['login_error' => 'Email atau password salah.']);
    // }

    public function login(Request $request)
    {
        $request->validate([
            'email_peserta' => 'required|email',
            'password' => 'required',
        ]);

        $peserta = $this->pesertaRepository->getByEmail($request->email_peserta);

        if ($peserta && Hash::check($request->password, $peserta->password)) {
            Session::put('peserta_logged_in', $peserta->id_peserta);
            return redirect()->route('home');
        }

        return back()->withErrors(['login_error' => 'Email atau password salah.']);
    }


    public function logout()
    {
        Session::forget('peserta_logged_in');
        return redirect()->route('login');
    }
}
