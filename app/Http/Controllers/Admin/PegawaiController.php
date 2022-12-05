<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $dataPegawai = Pegawai::orderBy('nama_in','asc')->get();
                
        if($request->ajax()){
            return datatables()->of($dataPegawai)
                ->addColumn('action', function($data){
                        $button = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->nip.'" data-toggle="tooltip" data-placement="bottom" title="Edit" data-original-title="Edit" class="edit btn btn-success btn-sm edit-post mb-1"><i class="bx bx-xs bx-edit"></i></a>';
                        $button .= '<button type="button" value="{{csrf_token()}}" name="delete" id="'.$data->nip.'" data-toggle="tooltip" data-placement="bottom" title="Delete" class="delete btn btn-danger btn-sm"><i class="bx bx-xs bx-trash"></i></button>';
                        return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn(true)
                ->make(true);
        }

        return view('admin.menu-user.pegawai.index');
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
            'nip'               => 'required',
            'nama_in'           => 'required',
            'jenis_kelamin'     => 'required',
            'nama_ch'           => 'required',
            'tanggal_lahir'     => 'required',
            'agama'             => 'required',
            'tanggal_masuk'     => 'required',
        ],[
            'nip.required'                  => 'Anda belum memilih periode',
            'nama_in.required'              => 'Anda belum mamasukkan nama Indonesia',
            'jenis_kelamin.required'        => 'Anda belum memasukan nama English',
            'nama_ch.required'              => 'Anda belum memasukan nama Mandarin',
            'tanggal_lahir.required'        => 'Anda belum memasukan golongan',
            'agama.required'                => 'Anda belum memasukan golongan',
            'tanggal_masuk.required'        => 'Anda belum memasukan golongan',

        ]);

        $post   =   Pegawai::updateOrCreate(['nip' => $request->nip],
                    [
                        'nip'               => $request->nip,
                        'jenis_kelamin'     => $request->jenis_kelamin,
                        'tanggal_lahir'     => $request->tanggal_lahir,
                        'nama_in'           => $request->nama_in,
                        'agama'             => $request->agama,
                        'nama_ch'           => $request->nama_ch,
                        'tanggal_masuk'     => $request->tanggal_masuk,
                        'id_status_pegawai' => 1,
                    ]); 

        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        //
        $where = array('nip' => $id);
        $post  = Pegawai::where($where)->first();
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //
        $post = Pegawai::where('nip',$id)->delete();     
        return response()->json($post);
    }
}
