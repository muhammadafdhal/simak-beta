@extends('layouts.master')

@section('title','Jabatan')

@section('masterJabatan')
active
@endsection

@section('jabatan')
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
                    <hr class="divide">
                    <div class="card-body card-dashboard ">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table_jabatan">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Periode</th>
                                        <th>Kode Jabatan</th>
                                        <th>Nama</th>
                                        <th>Golongan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                {{-- data body table jabatan --}}

                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Periode</th>
                                        <th>Kode Jabatan</th>
                                        <th>Nama</th>
                                        <th>Golongan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>

                            <!--Mulai form Modal tambah -->
                            <div class="modal fade" id="tambah-edit-modal" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="modal-judul"></h3>
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
                                                    <select class="select form-control" id="id_periode"
                                                        name="id_periode">
                                                        <option value="">Pilih</option>
                                                        @foreach ($periode as $value)
                                                        <option value="{{ $value->kode }}">{{ $value->nama_periode }}
                                                        </option>

                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger" id="idPeriodeErrorMsg"></span>
                                                </div>

                                                <fieldset class="form-group">
                                                    <label for="kode_jabatan">Kode Jabatan</label>
                                                    <input type="text" name="kode_jabatan"
                                                        value="{{ old('kode_jabatan') }}" class="form-control"
                                                        id="kode_jabatan" placeholder="Masukan Jabatan" />
                                                    <span class="text-danger" id="kodeJabatanErrorMsg"></span>
                                                </fieldset>

                                                <fieldset class="form-group">
                                                    <label for="nama_in">Nama ID</label>
                                                    <input type="text" name="nama_in" value="{{ old('nama_in') }}"
                                                        class="form-control" id="nama_in"
                                                        placeholder="Masukan Nama Indonesia" />
                                                    <span class="text-danger" id="namaInErrorMsg"></span>
                                                </fieldset>

                                                <fieldset class="form-group">
                                                    <label for="nama_en">Nama EN</label>
                                                    <input type="text" name="nama_en" value="{{ old('nama_en') }}"
                                                        class="form-control" id="nama_en"
                                                        placeholder="Masukan Nama English" />
                                                    <span class="text-danger" id="namaEnErrorMsg"></span>
                                                </fieldset>

                                                <fieldset class="form-group">
                                                    <label for="nama_ch">Nama CH</label>
                                                    <input type="text" name="nama_ch" value="{{ old('nama_ch') }}"
                                                        class="form-control" id="nama_ch"
                                                        placeholder="Masukan Nama Mandarin" />
                                                    <span class="text-danger" id="namaChErrorMsg"></span>
                                                </fieldset>


                                                <fieldset class="form-group">
                                                    <label for="golongan">Golongan</label>
                                                    <input type="number" name="golongan" value="{{ old('golongan') }}"
                                                        class="form-control" id="golongan"
                                                        placeholder="Masukan Golongan" />
                                                    <span class="text-danger" id="golonganErrorMsg"></span>
                                                </fieldset>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('jabatan.index') }}" type="button"
                                                class="btn btn-light-secondary" data-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Close</span>
                                            </a>
                                            <button type="submit" class="btn btn-primary ml-1" id="tombol-simpan"
                                                value="create">
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
        var table = $('#table_jabatan').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('jabatan.index') }}",
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
                    data: 'kode_jabatan',
                    name: 'kode_jabatan'
                },
                {
                    data: 'nama_in',
                    name: 'nama_in'
                },
                {
                    data: 'golongan',
                    name: 'golongan'
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
        $('#modal-judul').html("Tambah Data Jabatan");
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
                    url: "{{ route('jabatan.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#form-tambah-edit').trigger("reset");
                        $('#tambah-edit-modal').modal('hide');
                        $('#tombol-simpan').html('Save');
                        $('#table_jabatan').DataTable().ajax.reload(null, true);
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
                        $('#kodeJabatanErrorMsg').text(response.responseJSON.errors
                            .kode_jabatan);
                        $('#namaInErrorMsg').text(response.responseJSON.errors
                            .nama_in);
                        $('#namaEnErrorMsg').text(response.responseJSON.errors.nama_en);
                        $('#namaChErrorMsg').text(response.responseJSON.errors.nama_ch);
                        $('#golonganErrorMsg').text(response.responseJSON.errors.golongan);
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
        $.get('jabatan/' + data_id + '/edit', function (data) {
            $('#modal-judul').html("Form Edit Jabatan");
            $('#tombol-simpan').val("edit-post");
            $('#tambah-edit-modal').modal('show');

            $('#id').val(data.id);

            $('#id_periode').val(data.id_periode);
            $('#kode_jabatan').val(data.kode_jabatan);
            $('#nama_in').val(data.nama_in);
            $('#nama_en').val(data.nama_en);
            $('#nama_ch').val(data.nama_ch);
            $('#golongan').val(data.golongan);
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
                        url: "jabatan/" + dataId,
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
                        $('#table_jabatan').DataTable().ajax.reload(null, true);
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
