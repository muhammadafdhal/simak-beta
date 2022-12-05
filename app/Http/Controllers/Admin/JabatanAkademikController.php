<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\JabatanAkademik;
use App\Jabatan;
use App\Fakultas;
use App\Prodi;
use App\Periode;
use App\Pegawai;
use Illuminate\Http\Request;

class JabatanAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $dataJabatanAkademik = JabatanAkademik::leftJoin('periode','periode.kode','=','jabatan_akademik.id_periode')
            ->leftJoin('jabatan','jabatan.id','=','jabatan_akademik.id_jabatan')
            ->leftJoin('pegawai','pegawai.nip','=','jabatan_akademik.id_pegawai')
            ->leftJoin('fakultas','fakultas.id','=','jabatan_akademik.fakultas')
            ->leftJoin('prodi','prodi.id','=','jabatan_akademik.prodi')
            ->select('jabatan_akademik.id AS id','jabatan_akademik.*','periode.nama_periode','jabatan.nama_in AS nama_jabatan','fakultas.nama_in AS nama_fakultas','prodi.nama_in AS nama_prodi','pegawai.nama_in AS nama_pegawai')
            ->orderBy('created_at','desc')->get();
                
        if($request->ajax()){
            return datatables()->of($dataJabatanAkademik)
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
        $fakultas = Fakultas::where('is_archived','=',0)->get();
        $prodi = Prodi::where('is_archived','=',0)->get();
        $pegawai = Pegawai::all();

        return view('admin.menu-jabatan.jabatan-akademik.index', ['periode'=>$periode,'jabatan'=>$jabatan,'fakultas'=>$fakultas,'prodi'=>$prodi,'pegawai'=>$pegawai]);
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
            'fakultas'          => 'required',
            'prodi'             => 'required',
        ],[
            'id_periode.required'       => 'Anda belum memilih periode',
            'id_pegawai.required'       => 'Anda belum memasukan kode jabatan',
            'id_jabatan.required'       => 'Anda belum mamasukkan nama Indonesia',
            'fakultas.required'         => 'Anda belum memasukan nama English',
            'prodi.required'            => 'Anda belum memasukan nama Mandarin',

        ]);

        $post   =   JabatanAkademik::updateOrCreate(['id' => $request->id],
                    [
                        'id_periode'    => $request->id_periode,
                        'id_pegawai'    => $request->id_pegawai,
                        'id_jabatan'    => $request->id_jabatan,
                        'fakultas'      => $request->fakultas,
                        'prodi'         => $request->prodi,
                        'is_archived'   => 0,
                    ]); 

        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JabatanAkademik  $jabatanAkademik
     * @return \Illuminate\Http\Response
     */
    public function show(JabatanAkademik $jabatanAkademik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JabatanAkademik  $jabatanAkademik
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        //
        $where = array('id' => $id);
        $post  = JabatanAkademik::where($where)->first();
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JabatanAkademik  $jabatanAkademik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JabatanAkademik $jabatanAkademik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JabatanAkademik  $jabatanAkademik
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //
        $post = JabatanAkademik::where('id',$id)->delete();     
        return response()->json($post);
    }
}
