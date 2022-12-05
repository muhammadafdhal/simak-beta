<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    //
    protected $table = 'periode';
    protected $primaryKey = 'kode';
    protected $fillable = [
        'kode',
        'nama_periode',
        'is_active',
        'inputnilai',
        'temp_open',
        'finish',
    ];
    public $incrementing = false;
}
