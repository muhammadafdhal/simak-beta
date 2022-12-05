<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JabatanAkademik extends Model
{
    //
    protected $table = 'jabatan_akademik';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_periode',
        'id_pegawai',
        'id_jabatan',
        'fakultas',
        'prodi',
        'is_archived',
    ];
}
