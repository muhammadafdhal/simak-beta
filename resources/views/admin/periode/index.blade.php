@extends('layouts.master')

@section('title', 'Periode')

@section('content')

<div class="row">
    <div class="col-12">
        <p>
            Read full documnetation
            <a href="https://datatables.net/" target="_blank">here</a>
        </p>
    </div>
</div>
<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="card-header">
                            <h4 class="card-title">Tabel @yield('title')</h4>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <a href="javascript:void(0)" id="tombol-tambah" data-toggle="tooltip" title="Tambah"
                            class="btn btn-primary btn-icon mt-1 mr-2" style="float: right;"><i
                                class="bx bx-plus-medical"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table_periode">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama Periode</th>
                                    <th>Default</th>
                                    <th>Input Nilai</th>
                                    <th>Open</th>
                                    <th>Finish</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama Periode</th>
                                    <th>Default</th>
                                    <th>Input Nilai</th>
                                    <th>Open</th>
                                    <th>Finish</th>
                                </tr>
                            </tbody> --}}
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama Periode</th>
                                    <th>Default</th>
                                    <th>Input Nilai</th>
                                    <th>Open</th>
                                    <th>Finish</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- MULAI MODAL FORM TAMBAH/EDIT-->
            <div class="modal fade text-left" id="tambah-edit-modal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="modal-judul"></h3>
                            <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                <i class="bx bx-x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form-tambah-edit" name="form-tambah-edit">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <fieldset class="form-group">
                                            <label for="kode"><strong>Kode</strong></label>
                                            <input type="text" name="kode" value="{{ old('kode') }}"
                                                class="form-control" id="kode" placeholder="Masukan Kode" />
                                            <span class="text-danger" id="kodeErrorMsg"></span>
                                        </fieldset>

                                        <fieldset class="form-group">
                                            <label for="periode"><strong> Nama periode</strong></label>
                                            <input type="text" name="nama_periode" value="{{ old('nama_periode') }}"
                                                class="form-control" id="nama_periode" placeholder="Masukan Periode" />
                                            <span class="text-danger" id="namaPeriodeErrorMsg"></span>
                                        </fieldset>

                                        <label for="active">Default</label>
                                        <div class="form-group">
                                            <select class="form-control" id="is_active" name="is_active">
                                                <option value="">Pilih</option>
                                                <option value="1">Aktif</option>
                                                <option value="0">Tidak Aktif</option>
                                            </select>
                                            <span class="text-danger" id="isActiveErrorMsg"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="active">Input Nilai</label>
                                        <div class="form-group">
                                            <select class="form-control" id="inputnilai" name="inputnilai">
                                                <option value="">Pilih</option>
                                                <option value="1">Aktif</option>
                                                <option value="0">Tidak Aktif</option>
                                            </select>
                                            <span class="text-danger" id="inputNilaiErrorMsg"></span>
                                        </div>

                                        <label for="active">Status</label>
                                        <div class="form-group">
                                            <select class="form-control" id="temp_open" name="temp_open">
                                                <option value="">Pilih</option>
                                                <option value="1">Buka</option>
                                                <option value="0">Tutup</option>
                                            </select>
                                            <span class="text-danger" id="tempOpenErrorMsg"></span>
                                        </div>

                                        <label for="active">Finish</label>
                                        <div class="form-group">
                                            <select class=" form-control" id="finish" name="finish">
                                                <option value="">Pilih</option>
                                                <option value="1">Sudah</option>
                                                <option value="0">Belum</option>
                                            </select>
                                            <span class="text-danger" id="finishErrorMsg"></span>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#" type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </a>
                            <button type="submit" class="btn btn-primary ml-1" id="tombol-simpan">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Simpan</span>
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- AKHIR MODAL -->
        </div>
    </div>
</section>
<!--/ Zero configuration table -->

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
        var table = $('#table_periode').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('periode.index') }}",
            columns: [{
                    data: null,
                    sortable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1 + ".";
                    }
                },
                {
                    data: 'kode',
                    name: 'kode'
                },
                {
                    data: 'nama_periode',
                    name: 'nama_periode'
                },
                {
                    data: 'is_active',
                    name: 'is_active',
                    render: function (type, data, row) {
                        return (row.is_active == 1) ?
                            '<div class="badge badge-success badge-pill" style="font-size: 9px;">Aktif</div>' :
                            '<div class="badge badge-danger badge-pill" style="font-size: 9px;">Tidak Aktif</div>';
                    }

                },
                {
                    data: 'inputnilai',
                    name: 'inputnilai',
                    render: function (type, data, row) {
                        return (row.inputnilai == 1) ?
                            '<div class="badge badge-success badge-pill" style="font-size: 9px;">Aktif</div>' :
                            '<div class="badge badge-danger badge-pill" style="font-size: 9px;">Tidak Aktif</div>';
                    }
                },
                {
                    data: 'temp_open',
                    name: 'temp_open',
                    render: function (type, data, row) {
                        return (row.temp_open == 1) ?
                            '<div class="badge badge-success badge-pill" style="font-size: 9px;">Buka</div>' :
                            '<div class="badge badge-danger badge-pill" style="font-size: 9px;">Tutup</div>';
                    }
                },
                {
                    data: 'finish',
                    name: 'finish',
                    render: function (type, data, row) {
                        return (row.finish == 1) ?
                            '<div class="badge badge-success badge-pill" style="font-size: 9px;">Sudah</div>' :
                            '<div class="badge badge-danger badge-pill" style="font-size: 9px;">Belum</div>';
                    }
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
        $('#kode').val('');
        $('#form-tambah-edit').trigger("reset");
        $('#modal-judul').html("Tambah Data Periode");
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
                    url: "{{ route('periode.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#form-tambah-edit').trigger("reset");
                        $('#tambah-edit-modal').modal('hide');
                        $('#tombol-simpan').html('Save');
                        $('#table_periode').DataTable().ajax.reload(null, true);
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
                        $('#kodeErrorMsg').text(response.responseJSON.errors.kode);
                        $('#namaPeriodeErrorMsg').text(response.responseJSON.errors
                            .nama_periode);
                        $('#isActiveErrorMsg').text(response.responseJSON.errors
                            .is_active);
                        $('#inputNilaiErrorMsg').text(response.responseJSON.errors.inputnilai);
                        $('#tempOpenErrorMsg').text(response.responseJSON.errors.temp_open);
                        $('#finishErrorMsg').text(response.responseJSON.errors.finish);
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
        $.get('periode/' + data_id + '/edit', function (data) {
            $('#modal-judul').html("Edit data");
            $('#tombol-simpan').val("edit-post");
            $('#tambah-edit-modal').modal('show');

            // $('#id').val(data.id);
            $('#kode').val(data.kode);

            $('#nama_periode').val(data.nama_periode);


            $('#is_active option').filter(function () {
                return ($(this).val() == data.is_active);
            }).prop('selected', true);

            $('#inputnilai option').filter(function () {
                return ($(this).val() == data.inputnilai);
            }).prop('selected', true);

            $('#temp_open option').filter(function () {
                return ($(this).val() == data.temp_open);
            }).prop('selected', true);

            $('#finish option').filter(function () {
                return ($(this).val() == data.finish);
            }).prop('selected', true);
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
                        url: "periode/" + dataId,
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
                        $('#table_periode').DataTable().ajax.reload(null, true);
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
