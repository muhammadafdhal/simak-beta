<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    //
    protected $table = 'fakultas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_periode',
        'nama_in',
        'nama_en',
        'nama_ch',
        'is_archived',
    ];

    static function getArchivedFakultas()
    {
        $datas = Fakultas::leftJoin('periode','periode.kode','=','fakultas.id_periode')
            ->select('fakultas.id AS id','fakultas.*','periode.nama_periode')
            ->where('fakultas.is_archived','=',1)
            ->get();
        return $datas;
    }
}
