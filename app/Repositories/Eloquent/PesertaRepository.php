<?php

namespace App\Repositories\Eloquent;

use App\Models\Peserta;
use App\Repositories\Contracts\PesertaRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class PesertaRepository implements PesertaRepositoryInterface
{
    public function getAll()
    {
        return Peserta::with('jurusan')->get();
    }

    public function getById($id)
    {
        return Peserta::with('jurusan')->find($id);
    }

    public function create(array $data)
    {
        $peserta = Peserta::create($data);
        if (isset($data['jurusan_ids'])) {
            $peserta->jurusan()->sync($data['jurusan_ids']);
        }
        return $peserta;
    }

    public function update($id, array $data)
    {
        $peserta = Peserta::find($id);
        if ($peserta) {
            $peserta->update($data);
            if (isset($data['jurusan_ids'])) {
                $peserta->jurusan()->sync($data['jurusan_ids']);
            }
            return $peserta;
        }
        return null;
    }

    public function delete($id)
    {
        $peserta = Peserta::find($id);
        if ($peserta) {
            $peserta->delete();
            return true;
        }
        return false;
    }

    public function attachJurusan($id, array $jurusanIds)
    {
        $peserta = Peserta::find($id);
        if ($peserta) {
            $peserta->jurusan()->sync($jurusanIds);
            return $peserta;
        }
        return null;
    }

    public function getByEmail($email)
    {
        return Peserta::where('email_peserta', $email)->first();
    }

    public function authenticate($email, $password)
    {

        $peserta = Peserta::where('email_peserta', $email)->first();

        if ($peserta && Hash::check($password, $peserta->password)) {
            return $peserta;
        }

        return null;
    }
}
