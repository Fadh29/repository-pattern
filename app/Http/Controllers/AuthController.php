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

    public function login(Request $request)
    {
        $request->validate([
            'email_peserta' => 'required|email',
            'password' => 'required',
        ]);

        $peserta = $this->pesertaRepository->getByEmail($request->email_peserta);

        if ($peserta && Hash::check($request->password, $peserta->password)) {
            $token = $peserta->createToken('API Token')->plainTextToken;

            return response()->json([
                'message' => 'Login berhasil.',
                'token' => $token,
                'peserta' => $peserta,
            ], 200);
        }

        return response()->json([
            'message' => 'Email atau password salah.',
        ], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout berhasil.',
        ], 200);
    }
}
