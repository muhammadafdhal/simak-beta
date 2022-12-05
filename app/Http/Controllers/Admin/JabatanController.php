<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jabatan;
use App\Periode;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $dataJabatan = Jabatan::leftJoin('periode','periode.kode','=','jabatan.id_periode')
            ->select('jabatan.id AS id','jabatan.*','periode.nama_periode')
            ->orderBy('created_at','desc')->get();
                
        if($request->ajax()){
            return datatables()->of($dataJabatan)
                ->addColumn('action', function($data){
                        $button = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-toggle="tooltip" data-placement="bottom" title="Edit" data-original-title="Edit" class="edit btn btn-success btn-sm edit-post"><i class="bx bx-xs bx-edit"></i></a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" value="{{csrf_token()}}" name="delete" id="'.$data->id.'" data-toggle="tooltip" data-placement="bottom" title="Delete" class="delete btn btn-danger btn-sm"><i class="bx bx-xs bx-trash"></i></button>';
                        return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn(true)
                ->make(true);
        }
        $periode = Periode::where('is_active','=',1)->get();

        return view('admin.menu-jabatan.jabatan.index', ['periode'=>$periode]);
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
            'kode_jabatan'      => 'required',
            'nama_in'           => 'required',
            'nama_en'           => 'required',
            'nama_ch'           => 'required',
            'golongan'          => 'required',
        ],[
            'id_periode.required'    => 'Anda belum memilih periode',
            'kode_jabatan.required'  => 'Anda belum memasukan kode jabatan',
            'nama_in.required'       => 'Anda belum mamasukkan nama Indonesia',
            'nama_en.required'       => 'Anda belum memasukan nama English',
            'nama_ch.required'       => 'Anda belum memasukan nama Mandarin',
            'golongan.required'      => 'Anda belum memasukan golongan',

        ]);

        $post   =   Jabatan::updateOrCreate(['id' => $request->id],
                    [
                        'id_periode'  => $request->id_periode,
                        'kode_jabatan'=> $request->kode_jabatan,
                        'nama_in'     => $request->nama_in,
                        'nama_en'     => $request->nama_en,
                        'nama_ch'     => $request->nama_ch,
                        'golongan'    => $request->golongan,
                    ]); 

        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        //
        $where = array('id' => $id);
        $post  = Jabatan::where($where)->first();
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //
        $post = Jabatan::where('id',$id)->delete();     
        return response()->json($post);
    }
}
