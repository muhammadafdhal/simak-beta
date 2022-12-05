<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    //
    protected $table = 'prodi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_prodi',
        'kode_dikti',
        'id_fakultas',
        'id_periode',
        'nama_in',
        'nama_en',
        'nama_ch',
        'is_archived'
    ];
}
