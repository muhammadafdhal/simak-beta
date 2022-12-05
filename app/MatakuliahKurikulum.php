<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatakuliahKurikulum extends Model
{
    //
    protected $table = 'matakuliah_kurikulum';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_kurikulum',
        'kode_matakuliah',
        'wajib',
        'semeseter',
    ];
}
