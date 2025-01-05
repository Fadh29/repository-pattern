<?php

namespace App\Repositories\Contracts;

interface PesertaRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function attachJurusan($id, array $jurusanIds);
    public function getByEmail($email);
    public function authenticate($email, $password);
}
