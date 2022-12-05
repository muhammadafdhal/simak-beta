<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JabatanPegawai extends Model
{
    //
    protected $table = 'jabatan_pegawai';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_periode',
        'id_pegawai',
        'id_jabatan',
        'is_archived'
    ];
}
