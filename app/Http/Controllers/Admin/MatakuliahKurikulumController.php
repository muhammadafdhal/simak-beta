<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MatakuliahKurikulum;
use App\Kurikulum;
use App\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahKurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        //
        $dataMatakuliah = MatakuliahKurikulum::leftJoin('kurikulum','kurikulum.id','=','matakuliah_kurikulum.id_kurikulum')
            ->leftJoin('periode','periode.kode','=','kurikulum.id_periode')
            ->leftJoin('matakuliah','matakuliah.kode','=','matakuliah_kurikulum.kode_matakuliah')
            ->select('matakuliah_kurikulum.id AS id','matakuliah_kurikulum.*','kurikulum.nama','matakuliah.nama_in')
            ->where('periode.is_active','=',1)
            ->get();

        $dataKurikulum = Kurikulum::leftJoin('periode','periode.kode','=','kurikulum.id_periode')
            ->select('kurikulum.id AS id_kur','kurikulum.*','periode.nama_periode')
            ->where([['kurikulum.id','=',$id],['periode.is_active','=',1]])
            ->get();

        $matakuliah = Matakuliah::where('is_active','=',1)->get();
        $kurikulum = Kurikulum::where('is_active','=',1)->get();

        return view('admin.menu-kurikulum.matakuliah-kurikulum.index', ['id' => $id, 'dataMatakuliah' => $dataMatakuliah, 'dataKurikulum' => $dataKurikulum, 'matakuliah' => $matakuliah,'kurikulum' => $kurikulum]);
    }

    public function listMK(Request $request, $id)
    {            
        $getData = MatakuliahKurikulum::leftJoin('kurikulum','kurikulum.id','=','matakuliah_kurikulum.id_kurikulum')
        ->leftJoin('periode','periode.id','=','kurikulum.id_periode')
        ->leftJoin('matakuliah','matakuliah.kode','=','matakuliah_kurikulum.kode_matakuliah')
        ->select('matakuliah_kurikulum.id AS id','matakuliah_kurikulum.*','kurikulum.nama','matakuliah.nama_id','matakuliah.sks_teori','matakuliah.sks_praktek')
        ->where([['kurikulum.id','=',$id],['periode.is_active','=',1]])
        ->get();

        if($request->ajax()){
            return datatables()->of($getData)
                ->addColumn('action', function($data){
                   return '<button type="button" name="delete" id="'.$data->id.'" data-toggle="tooltip" data-placement="bottom" title="Delete" class="delete btn btn-danger btn-xs"><i class="bx bx-xs bx-trash"></i></button>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn(true)
                ->make(true);
        }
        return view('admin.menu-kurikulum.matakuliah-kurikulum.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MatakuliahKurikulum  $matakuliahKurikulum
     * @return \Illuminate\Http\Response
     */
    public function show(MatakuliahKurikulum $matakuliahKurikulum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MatakuliahKurikulum  $matakuliahKurikulum
     * @return \Illuminate\Http\Response
     */
    public function edit(MatakuliahKurikulum $matakuliahKurikulum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MatakuliahKurikulum  $matakuliahKurikulum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MatakuliahKurikulum $matakuliahKurikulum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MatakuliahKurikulum  $matakuliahKurikulum
     * @return \Illuminate\Http\Response
     */
    public function destroy(MatakuliahKurikulum $matakuliahKurikulum)
    {
        //
    }
}
