<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    //
    protected $table = 'matakuliah';
    protected $primaryKey = 'kode';
    protected $fillable = [
        'kode',
        'nama_in',
        'nama_en',
        'nama_ch',
        'sks_teori',
        'sks_praktek',
        'golongan_fakultas',
        'golongan_prodi',
        'id_periode',
        'is_active',
        'is_archived',
    ];
    public $incrementing = false;
}
