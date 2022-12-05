<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Fakultas;
use App\Periode;
use Illuminate\Http\Request;
use DataTables;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $dataFakultas = Fakultas::leftJoin('periode','periode.kode','=','fakultas.id_periode')
            ->select('fakultas.id AS id','fakultas.*','periode.nama_periode')
            ->where([['periode.is_active','=',1],['fakultas.is_archived','=',0]])
            ->get();
                
        if($request->ajax()){
            return datatables()->of($dataFakultas)
                ->addColumn('action', function($data){
                        $button = '<a href="javascript:void(0)" name="archive-faculty" data-toggle="tooltip" data-placement="bottom" title="Archive" onclick="archiveFaculty('.$data->id.','.$data->is_archived.')" data-id="'.$data->id.'" data-placement="bottom" data-original-title="archivefaculty" class="archivefaculty btn btn-warning btn-sm archive-post"><i class="bx bx-xs bx-archive"></i></a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="Edit" data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-success btn-sm edit-post"><i class="bx bx-xs bx-edit"></i></a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="bx bx-xs bx-trash"></i></button>';
                        return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn(true)
                ->make(true);
        }
        $periode = Periode::where('is_active','=',1)->get();
        return view('admin.menu-universitas.fakultas.index', ['periode'=>$periode]);
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
            'id_periode'        => 'required',
            'nama_in'           => 'required',
            'nama_en'           => 'required',
            'nama_ch'           => 'required',
        ],[
            'id_periode.required'    => 'Anda belum memilih periode',
            'nama_in.required'       => 'Anda belum mamasukkan nama Indonesia',
            'nama_en.required'       => 'Anda belum memasukan nama English',
            'nama_ch.required'       => 'Anda belum memasukan nama Mandarin',

        ]);

        $post   =   Fakultas::updateOrCreate(['id' => $request->id],
                    [
                        'id_periode'  => $request->id_periode,
                        'nama_in'     => $request->nama_in,
                        'nama_en'     => $request->nama_en,
                        'nama_ch'     => $request->nama_ch,
                        'is_archived' => 0
                    ]); 

        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function show(Fakultas $fakultas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        //
        $where = array('id' => $id);
        $post  = Fakultas::where($where)->first();
     
        return response()->json($post);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fakultas $fakultas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Fakultas::where('id',$id)->delete();     
        return response()->json($post);
    }
}
