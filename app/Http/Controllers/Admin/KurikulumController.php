<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Kurikulum;
use App\MatakuliahKurikulum;
use App\Periode;
use App\Prodi;
use DB;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $dataKurikulum = Kurikulum::leftJoin('prodi','prodi.id','=','kurikulum.id_prodi')
            ->leftJoin('periode','periode.kode','=','kurikulum.id_periode')
            ->select('kurikulum.id AS id','kurikulum.*','prodi.nama_in AS nama_prodi','periode.nama_periode','kurikulum.is_active AS is_active')
            ->where([['periode.is_active','=',1],['kurikulum.is_archived','=',0]])
            ->get();
                
        if($request->ajax()){
            return datatables()->of($dataKurikulum)
                ->addColumn('action', function($data){
                        $button = '<a href="javascript:void(0)" name="archive-kurikulum" data-toggle="tooltip" data-placement="bottom" title="Archive" onclick="archiveKurikulum('.$data->id.','.$data->is_archived.')" data-id="'.$data->id.'" data-placement="bottom" data-original-title="archivekurikulum" class="archivekurikulum btn btn-warning btn-xs archive-post"><i class="bx bx-xs bx-archive"></i></a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-toggle="tooltip" data-placement="bottom" title="Edit" data-original-title="Edit" class="edit btn btn-success btn-xs edit-post"><i class="bx bx-xs bx-edit"></i></a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" data-toggle="tooltip" data-placement="bottom" title="Delete" class="delete btn btn-danger btn-xs"><i class="bx bx-xs bx-trash"></i></button>';
                        return $button;
                })->addColumn('status', function($data){
                    return '<div class="custom-control">
                    <label class="switch switch-primary" for="'.$data->id.'">
                    <input type="checkbox" class="switch-input" onclick="KurikulumStatus('.$data->id.','.$data->is_active.')" name="kurikulum-status" id="'.$data->id.'" '.(($data->is_active=='1')?'checked':"").'>
                    <span class="switch-toggle-slider"><span class="switch-on"><i class="bx bx-check"></i></span><span class="switch-off"><i class="bx bx-x"></i></span></span></label></div>';
                })->addColumn('setting', function($data){
                    return '<a href="'.Route('setting.mkkurikulum',['id' => $data->id]).'" name="setting"  data-id="'.$data->id.'"> '.$data->nama.'</a>';
                })->addColumn('total_sks', function($data){
                    $total = $this->countWeight($data->id);
                    return ($total == null) ? '0 SKS' : $total .' SKS';
                })
                ->rawColumns(['action','status','setting','total_sks'])
                ->addIndexColumn(true)
                ->make(true);
        }
        $periode = Periode::where('is_active','=',1)->get();
        $prodi = Prodi::where('is_archived','=',0)->get();
        return view('admin.menu-kurikulum.kurikulum.index', ['periode'=>$periode, 'prodi'=>$prodi]);
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
     * @param  \App\Kurikulum  $kurikulum
     * @return \Illuminate\Http\Response
     */
    public function show(Kurikulum $kurikulum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kurikulum  $kurikulum
     * @return \Illuminate\Http\Response
     */
    public function edit(Kurikulum $kurikulum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kurikulum  $kurikulum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kurikulum $kurikulum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kurikulum  $kurikulum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kurikulum $kurikulum)
    {
        //
    }

    protected function countWeight($id_kurikulum)
    {
        $datas = MatakuliahKurikulum::leftJoin('matakuliah','matakuliah.kode','=','matakuliah_kurikulum.kode_matakuliah')
            ->leftJoin('kurikulum','kurikulum.id','=','matakuliah_kurikulum.id_kurikulum')
            ->select(DB::raw('sum(matakuliah.sks_teori + matakuliah.sks_praktek) as total'))
            ->where('kurikulum.id','=',$id_kurikulum)
            ->first();
        return $datas->total;
    }
}
