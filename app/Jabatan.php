<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    //
    protected $table = 'jabatan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_periode',
        'kode_jabatan',
        'nama_in',
        'nama_en',
        'nama_ch',
        'golongan',
    ];
}
