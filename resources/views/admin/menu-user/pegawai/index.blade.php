@extends('layouts.master')

@section('title0','User')
@section('title','Pegawai')

@section('user')
active
@endsection

@section('pegawai')
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
                            <table class="table table-striped" id="table_pegawai">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>nip</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Agama</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>nip</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Agama</th>
                                        <th>Tanggal Masuk</th>
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
                                            <h3 class="modal-title" id="modal-judul">Form Tambah Pegawai</h3>
                                            <button type="button" class="close rounded-pill" data-dismiss="modal"
                                                aria-label="Close">
                                                <i class="bx bx-x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="form-tambah-edit" name="form-tambah-edit">
                                                @csrf
                                                <fieldset class="form-group">
                                                    <label for="nip">NIP</label>
                                                    <input type="number" name="nip" value="{{ old('nip') }}"
                                                        class="form-control" id="nip"
                                                        placeholder="Masukan NIP" />
                                                        <span class="text-danger" id="nipErrorMsg"></span>
                                                </fieldset>

                                                <fieldset class="form-group">
                                                    <label for="nama_in">Nama ID</label>
                                                    <input type="text" name="nama_in" value="{{ old('nama_in') }}"
                                                        class="form-control"
                                                        id="nama_in" placeholder="Masukan Nama Indonesia" />
                                                        <span class="text-danger" id="namaInErrorMsg"></span>
                                                </fieldset>

                                                <fieldset class="form-group">
                                                    <label for="nama_ch">Nama CH</label>
                                                    <input type="text" name="nama_ch" value="{{ old('nama_ch') }}"
                                                        class="form-control"
                                                        id="nama_ch" placeholder="Masukan Nama Indonesia" />
                                                        <span class="text-danger" id="namChErrorMsg"></span>
                                                </fieldset>

                                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                                <div class="form-group">
                                                    <select
                                                        class="select form-control"
                                                        id="jenis_kelamin" name="jenis_kelamin">
                                                        <option value="">Pilih</option>

                                                        <option value="1">Laki-Laki</option>
                                                        <option value="0">Perempuan</option>
                                                    </select>
                                                    <span class="text-danger" id="jenisKelaminErrorMsg"></span>
                                                </div>

                                                <fieldset class="form-group">
                                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                                    <input type="date" name="tanggal_lahir"
                                                        value="{{ old('tanggal_lahir') }}"
                                                        class="form-control"
                                                        id="tanggal_lahir" placeholder="Masukan Tanggal Lahir" />
                                                        <span class="text-danger" id="tanggalLahirErrorMsg"></span>
                                                </fieldset>

                                                <label for="agama">Agama</label>
                                                <div class="form-group">
                                                    <select
                                                        class="select form-control"
                                                        id="agama" name="agama">
                                                        <option value="">Pilih</option>

                                                        <option value="Islam">Islam</option>
                                                        <option value="Buddha">Buddha</option>
                                                        <option value="Kristen Protestan">Kristen Protestan</option>
                                                        <option value="Kristen Katolik">Kristen Katolik</option>
                                                        <option value="Konghucu">Konghucu</option>
                                                        <option value="Hindu">Hindu</option>
                                                    </select>
                                                    <span class="text-danger" id="agamaErrorMsg"></span>
                                                </div>

                                                <fieldset class="form-group">
                                                    <label for="tanggal_masuk">Tanggal Masuk</label>
                                                    <input type="date" name="tanggal_masuk"
                                                        value="{{ old('tanggal_masuk') }}"
                                                        class="form-control"
                                                        id="tanggal_masuk" placeholder="Masukan Nama Mandarin" />
                                                        <span class="text-danger" id="tanggalMasukErrorMsg"></span>
                                                </fieldset>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('pegawai.index') }}" type="button"
                                                class="btn btn-light-secondary" data-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Close</span>
                                            </a>
                                            <button type="submit" class="btn btn-primary ml-1" id="tombol-simpan" value="create">
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
        var table = $('#table_pegawai').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('pegawai.index') }}",
            columns: [{
                    data: null,
                    sortable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1 + ".";
                    }
                },
                {
                    data: 'nip',
                    name: 'nip'
                },
                {
                    data: 'nama_in',
                    name: 'nama_in'
                },
                {
                    data: 'jenis_kelamin',
                    name: 'jenis_kelamin',
                    render: function (type, data, row) {
                        return (row.jenis_kelamin == 1) ?
                            'Laki-Laki' :
                            'Perempuan';
                    }
                },
                {
                    data: 'tanggal_lahir',
                    name: 'tanggal_lahir'
                },
                {
                    data: 'agama',
                    name: 'agama'
                },
                {
                    data: 'tanggal_masuk',
                    name: 'tanggal_masuk'
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
        $('#modal-judul').html("Tambah Data Pegawai");
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
                    url: "{{ route('pegawai.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#form-tambah-edit').trigger("reset");
                        $('#tambah-edit-modal').modal('hide');
                        $('#tombol-simpan').html('Save');
                        $('#table_pegawai').DataTable().ajax.reload(null, true);
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
                        $('#nipErrorMsg').text(response.responseJSON.errors.nip);
                        $('#namaInErrorMsg').text(response.responseJSON.errors
                            .nama_in);
                        $('#namChErrorMsg').text(response.responseJSON.errors
                            .nama_ch);
                        $('#jenisKelaminErrorMsg').text(response.responseJSON.errors.jenis_kelamin);
                        $('#tanggalLahirErrorMsg').text(response.responseJSON.errors.tanggal_lahir);
                        $('#agamaErrorMsg').text(response.responseJSON.errors.agama);
                        $('#tanggalMasukErrorMsg').text(response.responseJSON.errors.tanggal_masuk);
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
        $.get('pegawai/' + data_id + '/edit', function (data) {
            $('#modal-judul').html("Form Edit Pegawai");
            $('#tombol-simpan').val("edit-post");
            $('#tambah-edit-modal').modal('show');

            $('#nip').val(data.nip);

            $('#nama_in').val(data.nama_in);
            $('#nama_ch').val(data.nama_ch);
            $('#jenis_kelamin').val(data.jenis_kelamin);
            $('#tanggal_lahir').val(data.tanggal_lahir);
            $('#agama').val(data.agama);
            $('#tanggal_masuk').val(data.tanggal_masuk);
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
                        url: "pegawai/" + dataId,
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
                        $('#table_pegawai').DataTable().ajax.reload(null, true);
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
