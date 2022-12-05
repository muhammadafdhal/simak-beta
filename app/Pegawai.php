<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    //
    protected $table = 'pegawai';
    protected $primaryKey = 'nip';
    protected $fillable = [
        'nip',
        'nama_in',
        'nama_ch',
        'jenis_kelamin',
        'tanggal_lahir',
        'agama',
        'id_status_pegawai',
        'tanggal_masuk',
    ];

    public $incrementing = false;
}
