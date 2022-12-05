<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Matakuliah;
use App\Periode;
use App\Fakultas;
use App\Prodi;
use Illuminate\Http\Request;
use DataTables;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $dataMatakuliah = Matakuliah::leftJoin('periode','periode.kode','=','matakuliah.id_periode')
            ->leftJoin('prodi','prodi.id','=','matakuliah.golongan_prodi')
            ->select('matakuliah.kode AS kode','matakuliah.*','periode.nama_periode','prodi.nama_in AS nama_prodi')
            ->where([['periode.is_active','=',1],['matakuliah.is_archived','=',0]])
            ->get();
                
        if($request->ajax()){
            return datatables()->of($dataMatakuliah)
                ->addColumn('action', function($data){
                        $button = '<a href="javascript:void(0)" name="archive-matakuliah" data-toggle="tooltip" data-placement="bottom" title="Archive" onclick="archiveMatakuliah('.$data->kode.','.$data->is_archived.')" data-id="'.$data->kode.'" data-placement="bottom" data-original-title="archivematakuliah" class="archivematakuliah btn btn-warning btn-sm archive-post"><i class="bx bx-xs bx-archive"></i></a>';
                        $button .= '&nbsp;';
                        $button .= '<a href="javascript:void(0)" data-id="'.$data->kode.'" data-toggle="tooltip" data-placement="bottom" title="Edit" class="edit btn btn-success btn-sm edit-post"><i class="bx bx-xs bx-edit"></i></a>';
                        $button .= '&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->kode.'" class="delete btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="bx bx-xs bx-trash"></i></button>';
                        return $button;
                })->addColumn('status', function($data){
                    return '<div class="custom-control">
                    <label class="switch switch-primary" for="'.$data->kode.'">
                    <input type="checkbox" class="switch-input" onclick="MatakuliahStatus('.$data->kode.','.$data->is_active.')" name="matakuliah-status" id="'.$data->kode.'" '.(($data->is_active=='1')?'checked':"").'>
                    <span class="switch-toggle-slider"><span class="switch-on"><i class="bx bx-check"></i></span><span class="switch-off"><i class="bx bx-x"></i></span></span></label></div>';
                })
                ->rawColumns(['action','status'])
                ->addIndexColumn(true)
                ->make(true);
        }
        $periode = Periode::where('is_active','=',1)->get();
        $fakultas = Fakultas::where('is_archived','=',0)->get();
        $prodi = Prodi::where('is_archived','=',0)->get();
        return view('admin.menu-kurikulum.matakuliah.index', ['periode'=>$periode,'fakultas'=>$fakultas, 'prodi'=>$prodi]);
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
        $request->validate([
            'kode'              => 'required',
            'nama_in'           => 'required',
            'nama_en'           => 'required',
            'nama_ch'           => 'required',
            'sks_teori'         => 'required',
            'sks_praktek'       => 'required',
            'golongan_fakultas' => 'required',
            'golongan_prodi'    => 'required',
            'id_periode'        => 'required',
        ],[
            'kode.required'              => 'Anda belum menginputkan kode matakuliah',
            'nama_in.required'           => 'Anda belum menginputkan nama',
            'nama_en.required'           => 'Anda belum menginputkan nama',
            'nama_ch.required'           => 'Anda belum menginputkan nama',
            'sks_teori.required'         => 'Anda belum menginputkan jumlah SKS teori',
            'sks_praktek.required'       => 'Anda belum menginputkan jumlah SKS praktek',
            'golongan_fakultas.required' => 'Anda belum memilih golongan fakultas',
            'golongan_prodi.required'    => 'Anda belum memilih golongan prodi',
            'id_periode.required'        => 'Anda belum memilih periode'
        ]);

        $post = Matakuliah::updateOrCreate(['kode' => $request->kode],
                [
                    'kode'              => $request->kode,
                    'nama_in'           => $request->nama_in,
                    'nama_en'           => $request->nama_en,
                    'nama_ch'           => $request->nama_ch,
                    'sks_teori'         => $request->sks_teori,
                    'sks_praktek'       => $request->sks_praktek,
                    'golongan_fakultas' => $request->golongan_fakultas,
                    'golongan_prodi'    => $request->golongan_prodi,
                    'id_periode'        => $request->id_periode,
                    'is_active'         => 1,
                    'is_archived'       => 0
                ]); 

        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Matakuliah  $matakuliah
     * @return \Illuminate\Http\Response
     */
    public function show(Matakuliah $matakuliah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Matakuliah  $matakuliah
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $where = array('kode' => $id);
        $post  = Matakuliah::where($where)->first();
     
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Matakuliah  $matakuliah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $matakuliah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Matakuliah  $matakuliah
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //
        $post = Matakuliah::where('kode',$id)->delete();     
        return response()->json($post);
    }
}
