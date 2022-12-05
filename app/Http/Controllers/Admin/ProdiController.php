<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Prodi;
use App\Fakultas;
use App\Periode;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $dataProdi = Prodi::leftJoin('periode','periode.kode','=','prodi.id_periode')
            ->leftJoin('fakultas','fakultas.id','=','prodi.id_fakultas')
            ->select('prodi.id AS id','prodi.*','periode.nama_periode','fakultas.nama_in AS nama_fakultas')
            ->where([['periode.is_active','=',1],['prodi.is_archived','=',0]])
            ->orderBy('created_at','desc')
            ->get();
                
        if($request->ajax()){
            return datatables()->of($dataProdi)
                ->addColumn('action', function($data){
                        $button = '<a href="javascript:void(0)" name="archive-prodi" data-toggle="tooltip" data-placement="bottom" title="Archive" onclick="archiveProdi('.$data->id.','.$data->is_archived.')" data-id="'.$data->id.'" data-placement="bottom" data-original-title="archiveprodi" class="archiveprodi btn btn-warning btn-sm archive-post"><i class="bx bx-xs bx-archive"></i></a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-toggle="tooltip" data-placement="bottom" title="Edit" data-original-title="Edit" class="edit btn btn-success btn-sm edit-post"><i class="bx bx-xs bx-edit"></i></a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" data-toggle="tooltip" data-placement="bottom" title="Delete" class="delete btn btn-danger btn-sm"><i class="bx bx-xs bx-trash"></i></button>';
                        return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn(true)
                ->make(true);
        }
        $fakultas = Fakultas::where('is_archived','=',0)->get();
        $periode = Periode::where('is_active','=',1)->get();
        return view('admin.menu-universitas.prodi.index', ['fakultas'=>$fakultas, 'periode'=>$periode]);
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
            'kode_prodi'    => 'required',
            'kode_dikti'    => 'required',
            'id_fakultas'   => 'required',
            'id_periode'    => 'required',
            'nama_in'       => 'required',
            'nama_en'       => 'required',
            'nama_ch'       => 'required',
        ],[
            'kode_prodi.required'    => 'Anda belum menginputkan kode prodi',
            'kode_dikti.required'    => 'Anda belum menginputkan kode dikti',
            'id_fakultas.required'   => 'Anda belum memilih fakultas',
            'id_periode.required'    => 'Anda belum memilih periode',
            'nama_in.required'       => 'Anda belum menginputkan nama',
            'nama_en.required'       => 'Anda belum menginputkan nama',
            'nama_ch.required'       => 'Anda belum menginputkan nama'
        ]);

        $post = Prodi::updateOrCreate(['id' => $request->id],
                [
                    'kode_prodi'        => $request->kode_prodi,
                    'kode_dikti'        => $request->kode_dikti,
                    'id_fakultas'       => $request->id_fakultas,
                    'id_periode'        => $request->id_periode,
                    'nama_in'           => $request->nama_in,
                    'nama_en'           => $request->nama_en,
                    'nama_ch'           => $request->nama_ch,
                    'is_archived'       => 0
                ]); 

        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function show(Prodi $prodi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        //
        $where = array('id' => $id);
        $post  = Prodi::where($where)->first();     
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prodi $prodi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //
        $post = Prodi::where('id',$id)->delete();
        return response()->json($post);
    }
}
