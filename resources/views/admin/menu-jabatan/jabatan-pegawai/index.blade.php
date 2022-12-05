@extends('layouts.master')

@section('title','Jabatan Pegawai')

@section('masterJabatan')
active
@endsection

@section('jabatan_pegawai')
active
@endsection

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
                        <i class="bx bxs-x-circle"></i>
                        <span>
                            {{ $message }}
                        </span>
                    </div>
                </div>
                @endif

                <div class="card">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card-header">
                                <h4 class="card-title">Tabel @yield('title')</h4>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <button type="button" data-toggle="modal" data-target="#show-archived"
                                class="btn btn-icon btn-warning mr-1 mt-1" style="float: right;"><i
                                    data-toggle="tooltip" title="Lihat Arsip" class="bx bx-archive"></i>
                            </button>
                            <a href="javascript:void(0)" id="tombol-tambah" data-toggle="tooltip" title="Tambah"
                                class="btn btn-primary btn-icon mt-1 mr-1" style="float: right;"><i
                                    class="bx bx-plus-medical"></i>
                            </a>
                        </div>
                    </div>
                    <hr class="divide">
                    <div class="card-body card-dashboard ">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table_jabatan_pegawai">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Periode</th>
                                        <th>Pegawai</th>
                                        <th>Jabatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Periode</th>
                                        <th>Pegawai</th>
                                        <th>Jabatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>

                            <!--Mulai form Modal edit -->
                            <div class="modal fade text-left" id="tambah-edit-modal" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="modal-judul">Form Tambah Periode</h3>
                                            <button type="button" class="close rounded-pill" data-dismiss="modal"
                                                aria-label="Close">
                                                <i class="bx bx-x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="form-tambah-edit" name="form-tambah-edit">
                                                @csrf

                                                <input type="hidden" name="id" id="id" value="">

                                                <label for="id_periode">Periode</label>
                                                <div class="form-group">
                                                    <select
                                                        class="select form-control"
                                                        id="id_periode" name="id_periode">
                                                        <option value="">Pilih</option>
                                                        @foreach ($periode as $value)
                                                        <option value="{{ $value->kode }}">{{ $value->nama_periode }}
                                                        </option>

                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger" id="idPeriodeErrorMsg"></span>
                                                </div>

                                                <label for="id_pegawai">Pegawai</label>
                                                <div class="form-group">
                                                    <select
                                                        class="select form-control"
                                                        id="id_pegawai" name="id_pegawai">
                                                        <option value="">Pilih</option>
                                                        @foreach ($pegawai as $value)
                                                        <option value="{{ $value->nip }}">{{ $value->nama_in }}
                                                        </option>

                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger" id="idPegawaiErrorMsg"></span>
                                                </div>

                                                <label for="id_jabatan">Jabatan</label>
                                                <div class="form-group">
                                                    <select
                                                        class="select form-control"
                                                        id="id_jabatan" name="id_jabatan">
                                                        <option value="">Pilih</option>
                                                        @foreach ($jabatan as $value)
                                                        <option value="{{ $value->id }}">{{ $value->nama_in }}
                                                        </option>

                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger" id="idJabatanErrorMsg"></span>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('jabatan-pegawai.index') }}" type="button"
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
                            <!--Akhir form Modal edit -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Zero configuration table -->

</div>
@endsection

@push('after-scripts')
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
        var table = $('#table_jabatan_pegawai').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('jabatan-pegawai.index') }}",
            columns: [{
                    data: null,
                    sortable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1 + ".";
                    }
                },
                {
                    data: 'nama_periode',
                    name: 'nama_periode'
                },
                {
                    data: 'nama_pegawai',
                    name: 'nama_pegawai'
                },
                {
                    data: 'nama_jabatan',
                    name: 'nama_jabatan'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });
    });

    //TOMBOL TAMBAH DATA
    $('#tombol-tambah').click(function () {
        $('#button-simpan').val("create-post");
        $('#id').val('');
        $('#form-tambah-edit').trigger("reset");
        $('#modal-judul').html("Tambah Data Jabatan Pegawai");
        $('#tambah-edit-modal').modal('show');
    });

    // TOMBOL TAMBAH
    if ($("#form-tambah-edit").length > 0) {
        $("#form-tambah-edit").validate({
            submitHandler: function (form) {
                var actionType = $('#tombol-simpan').val();
                $('#tombol-simpan').html('Saving..');

                $.ajax({
                    data: $('#form-tambah-edit').serialize(),
                    url: "{{ route('jabatan-pegawai.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#form-tambah-edit').trigger("reset");
                        $('#tambah-edit-modal').modal('hide');
                        $('#tombol-simpan').html('Save');
                        $('#table_jabatan_pegawai').DataTable().ajax.reload(null, true);
                        Swal.fire({
                            title: 'Good job!',
                            text: 'Data saved successfully!',
                            type: 'success',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false,
                            timer: 2000
                        })
                    },
                    error: function (response) {
                        $('#idPeriodeErrorMsg').text(response.responseJSON.errors.id_periode);
                        $('#idPegawaiErrorMsg').text(response.responseJSON.errors
                            .id_pegawai);
                        $('#idJabatanErrorMsg').text(response.responseJSON.errors
                            .id_jabatan);
                        $('#tombol-simpan').html('Save');
                        Swal.fire({
                            title: 'Error!',
                            text: 'Data failed to save!',
                            type: 'error',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false,
                            timer: 2000
                        })
                    }
                });
            }
        })
    }

    // EDIT DATA
    $('body').on('click', '.edit-post', function () {
        var data_id = $(this).data('id');
        $.get('jabatan-pegawai/' + data_id + '/edit', function (data) {
            $('#modal-judul').html("Form Edit Jabatan Pegawai");
            $('#tombol-simpan').val("edit-post");
            $('#tambah-edit-modal').modal('show');

            $('#id').val(data.id);

            $('#id_periode').val(data.id_periode);
            $('#id_pegawai').val(data.id_pegawai);
            $('#id_jabatan').val(data.id_jabatan);
        })
    });

    // TOMBOL DELETE
    $(document).on('click', '.delete', function () {
        dataId = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "It will be deleted permanently!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return new Promise(function (resolve) {
                    $.ajax({
                        url: "jabatan-pegawai/" + dataId,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": dataId
                        },
                        dataType: 'json'
                    }).done(function (response) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Your data has been deleted.',
                            type: 'success',
                            timer: 2000
                        })
                        $('#table_jabatan_pegawai').DataTable().ajax.reload(null, true);
                    }).fail(function () {
                        Swal.fire({
                            title: 'Oops!',
                            text: 'Something went wrong with ajax!',
                            type: 'error',
                            timer: 2000
                        })
                    });
                });
            },
        });
    });

</script>
@endpush
