<?php

namespace App\Repositories\Eloquent;

use App\Models\Jurusan;
use App\Repositories\Contracts\JurusanRepositoryInterface;

class JurusanRepository extends BaseRepository implements JurusanRepositoryInterface
{
    public function __construct(Jurusan $jurusan)
    {
        $this->model = $jurusan;
    }

    public function update($id, array $data)
    {
        $jurusan = $this->model->find($id);
        if ($jurusan) {
            $jurusan->update($data);
            return $jurusan;
        }
        return null;
    }
}
