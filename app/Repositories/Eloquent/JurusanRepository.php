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
}
