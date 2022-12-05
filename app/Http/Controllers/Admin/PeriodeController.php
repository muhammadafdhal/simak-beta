<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Periode;
use Illuminate\Http\Request;
use DataTables;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $dataPeriode = Periode::orderBy('created_at','desc')->get();
                
        if($request->ajax()){
            return datatables()->of($dataPeriode)
                ->addColumn('action', function($data){
                        $button = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->kode.'" data-toggle="tooltip" data-placement="bottom" title="Edit" data-original-title="Edit" class="edit btn btn-success btn-sm edit-post mb-1"><i class="bx bx-xs bx-edit"></i></a>';
                        $button .= '<button type="button" value="{{csrf_token()}}" name="delete" id="'.$data->kode.'" data-toggle="tooltip" data-placement="bottom" title="Delete" class="delete btn btn-danger btn-sm"><i class="bx bx-xs bx-trash"></i></button>';
                        return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn(true)
                ->make(true);
        }

        return view('admin.periode.index');
    }

    
    public function store(Request $request)
    {
        //
        $request->validate([
            'kode'         => 'required',
            'nama_periode' => 'required',
            'is_active'    => 'required',
            'inputnilai'  => 'required',
            'temp_open'    => 'required',
            'finish'       => 'required',
        ],[
            'kode.required'         => 'Anda belum menginputkan kode',
            'is_active.required'    => 'Anda belum menginputkan default',
            'nama_periode.required' => 'Anda belum menginputkan nama periode',
            'inputnilai.required'  => 'Anda belum menginputkan nilai',
            'temp_open.required'    => 'Anda belum menginputkan temp open',
            'finish.required'       => 'Anda belum menginputkan finish',
        ]);

        // $checkState = Periode::where('is_active','=',1)->get();
        // $isActive = $request->input('is_active');
        // foreach($checkState as $data){
        //     if($isActive == null) {
        //         $isActive = 0;
        //     } else {
        //         $data->update(['is_active' => 0]);
        //         $isActive = 1;
        //     }
        // }

        $post = Periode::updateOrCreate(['kode' => $request->kode],
                [
                    'nama_periode'  => $request->nama_periode,
                    'inputnilai'    => $request->inputnilai,
                    'temp_open'     => $request->temp_open,
                    'finish'        => $request->finish,
                    'is_active'     => $request->is_active
                ]); 

        return response()->json($post);
    }

    public function edit($id)
    {
        //
        $where = array('kode' => $id);
        $post  = Periode::where($where)->first();
     
        return response()->json($post);
    }

    public function destroy( $id)
    {
        //
        $post = Periode::where('kode',$id)->delete();     
        return response()->json($post);
    }
}
