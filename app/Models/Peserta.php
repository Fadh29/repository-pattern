<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Peserta extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'peserta';
    protected $primaryKey = 'id_peserta';
    protected $fillable = [
        'nama_peserta',
        'jenis_kelamin_peserta',
        'alamat_peserta',
        'email_peserta',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function jurusan()
    {
        return $this->belongsToMany(Jurusan::class, 'jurusan_peserta', 'id_peserta', 'id_jurusan');
    }
}
