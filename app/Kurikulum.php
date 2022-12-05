<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    //
    protected $table = 'kurikulum';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'id_prodi',
        'id_periode',
        'is_active',
        'is_archived',
    ];
}
