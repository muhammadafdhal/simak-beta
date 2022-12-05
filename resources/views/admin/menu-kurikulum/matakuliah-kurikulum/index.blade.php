@extends('layouts.master')

@section('masterKurikulum')
active
@endsection

@section('kurikulum')
active
@endsection

@section('title0', 'Kurikulum')
@section('title', 'Matakuliah Per Kurikulum')

@section('content')
<div class="content-body">
    <!-- Zero configuration table -->
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                @if ($message = Session::get('success'))
                <div class="alert bg-rgba-success alert-dismissible mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="d-flex align-items-center">
                        <i class="bx bxs-check-circle"></i>
                        <span>
                            {{ $message }}
                        </span>
                    </div>
                </div>
                @endif

                @if ($message = Session::get('error'))
                <div class="alert bg-rgba-danger alert-dismissible mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="d-flex align-items-center">
                        <i class="bx bx-star"></i>
                        <span>
                            {{ $message }}
                        </span>
                    </div>
                </div>

                @endif
                <div class="card">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="card-header">
                                <h4 class="card-title">Tabel @yield('title')</h4>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <button type="button" data-toggle="modal" data-target="#default"
                                class="btn btn-primary round mt-1 mr-2" style="float: right;">Tambah
                            </button>
                        </div>
                    </div>
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table id="table_mk_kurikulum" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Kode</th>
                                        <th rowspan="2">Nama</th>
                                        <th rowspan="2">SKS Total</th>
                                        <th colspan="2" style="text-align: center">Bobot Matakuliah (SKS)</th>
                                        <th rowspan="2">Semester</th>
                                        <th rowspan="2">Wajib</th>
                                        <th rowspan="2" style="text-align: center">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th>Teori</th>
                                        <th>Praktek</th>
                                    </tr>
                                </thead>

                                <tfoot>
                                    <tr>
                                        <th colspan="1">Total</th>
                                        <th colspan="2"></th>
                                        <th>56</th>
                                        <th>3</th>
                                        <th>2</th>
                                        <th colspan="3"></th>
                                    </tr>
                                </tfoot>
                            </table>

                            <!--Mulai form Modal tambah -->
                            <div class="modal fade text-left" id="default" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="myModalLabel1">Form Tambah Matakuliah</h3>
                                            <button type="button" class="close rounded-pill" data-dismiss="modal"
                                                aria-label="Close">
                                                <i class="bx bx-x"></i>
                                            </button>
                                        </div>
                                        <form
                                            action=""
                                            method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">

                                                        <label for="periode">MataKuliah</label>
                                                        <div class="form-group">
                                                            <select
                                                                class="select2 form-control @error('kode_matakuliah') is-invalid @enderror"
                                                                id="matakuliah" name="kode_matakuliah">
                                                                <option value="">Pilih Matakuliah</option>
                                                                @foreach ($matakuliah as $data)
                                                                <option value="{{ $data->kode }}">
                                                                    {{ $data->nama_in }}</option>

                                                                @endforeach
                                                            </select>

                                                            @error('kode_matakuliah')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>Tidak Boleh Kosong</strong>
                                                            </span>
                                                            @enderror
                                                        </div>

                                                        <fieldset class="form-group">
                                                            <label>Semester</label>
                                                            <input type="number" name="semester"
                                                                value="{{ old('semester') }}"
                                                                class="form-control @error('semester') is-invalid @enderror"
                                                                id="semester" placeholder="Masukan Semester" />

                                                            @error('semester')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>Tidak Boleh Kosong</strong>
                                                            </span>
                                                            @enderror

                                                        </fieldset>

                                                        <fieldset>
                                                            <div class="checkbox">
                                                                <input type="checkbox" name="wajib" value="1"
                                                                    class="checkbox-input" id="checkbox2">
                                                                <label for="checkbox2">Wajib</label>
                                                            </div>
                                                        </fieldset>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="" type="button"
                                                    class="btn btn-light-secondary" data-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Close</span>
                                                </a>
                                                <button type="submit" class="btn btn-primary ml-1">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Simpan</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--Akhir form Modal tambah -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Zero configuration table -->


</div>
@endsection

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    // DATATABLE
    $(document).ready(function () {
        var table = $('#table_mk_kurikulum').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('list.mkkurikulum',['id' => $id]) }}",
            columns: [
                {data: null,sortable:false,
                    render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }, 
                {data: 'kode_matakuliah',name: 'kode_matakuliah',
                    render: function ( data, type, row ) {
                        return row.kode_matakuliah + ' > ' + row.nama_id;
                    },
                },
                {data: 'nama_in', name: 'nama_in'},
                {data: 'sks_teori',name: 'sks_teori'},
                {data: 'sks_praktek',name: 'sks_praktek'},
                {data: 'semester',name: 'semester'},
                {data: 'wajib',name: 'wajib', render: function(type,data,row){ return (row.wajib == 1) ? '<button type="button" class="btn btn-outline-success btn-xs">Yes <i class="bx bx-check-circle bx-xs"></i></button>' : '<button type="button" class="btn btn-outline-danger btn-xs">No <i class="bx bx-x-circle bx-xs"></i></button>';}},
                {data: 'action',name: 'action'},
            ]
        });
    });


</script>

