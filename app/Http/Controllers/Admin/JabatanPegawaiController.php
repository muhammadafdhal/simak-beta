<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\JabatanPegawai;
use Illuminate\Http\Request;
use App\Periode;
use App\Jabatan;
use App\Pegawai;

class JabatanPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dataJabatanPegawai = JabatanPegawai::leftJoin('periode','periode.kode','=','jabatan_pegawai.id_periode')
            ->leftJoin('jabatan','jabatan.id','=','jabatan_pegawai.id_jabatan')
            ->leftJoin('pegawai','pegawai.nip','=','jabatan_pegawai.id_pegawai')
            ->select('jabatan_pegawai.id AS id','jabatan_pegawai.*','periode.nama_periode','jabatan.nama_in AS nama_jabatan','pegawai.nama_in AS nama_pegawai')
            ->orderBy('created_at','desc')->get();
                
        if($request->ajax()){
            return datatables()->of($dataJabatanPegawai)
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
        $jabatan = Jabatan::all();
        $pegawai = Pegawai::all();

        return view('admin.menu-jabatan.jabatan-pegawai.index', ['periode'=>$periode,'jabatan'=>$jabatan,'pegawai'=>$pegawai]);
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
        $request->validate([
            'id_periode'        => 'required',
            'id_pegawai'        => 'required',
            'id_jabatan'        => 'required',
        ],[
            'id_periode.required'       => 'Anda belum memilih periode',
            'id_pegawai.required'       => 'Anda belum memasukan kode jabatan',
            'id_jabatan.required'       => 'Anda belum mamasukkan nama Indonesia',

        ]);

        $post   =   JabatanAkademik::updateOrCreate(['id' => $request->id],
                    [
                        'id_periode'    => $request->id_periode,
                        'id_pegawai'    => $request->id_pegawai,
                        'id_jabatan'    => $request->id_jabatan,
                        'is_archived'   => 0,
                    ]); 

        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JabatanPegawai  $jabatanPegawai
     * @return \Illuminate\Http\Response
     */
    public function show(JabatanPegawai $jabatanPegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JabatanPegawai  $jabatanPegawai
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        //
        $where = array('id',$id);
        $post = JabatanPegawai::where($where)->first();
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JabatanPegawai  $jabatanPegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JabatanPegawai $jabatanPegawai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JabatanPegawai  $jabatanPegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $post = JabatanPegawai::where('id',$id)->delete();
        return response()->json($post);
    }
}
