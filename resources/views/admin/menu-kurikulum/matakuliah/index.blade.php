@extends('layouts.master')

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
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table id="table_matakuliah" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama Matakuliah</th>
                                        <th>Prodi</th>
                                        <th>Periode</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                {{-- BEGIN --}}

                                {{-- tabel body server side --}}

                                {{-- END --}}

                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama Matakuliah</th>
                                        <th>Prodi</th>
                                        <th>Periode</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>

                            <!--Mulai form Modal -->
                            <div class="modal fade text-left" id="tambah-edit-modal" aria-hidden="true">
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
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <fieldset class="form-group">
                                                            <label for="kode">Kode</label>
                                                            <input type="text" name="kode" value="{{ old('kode') }}"
                                                                class="form-control"
                                                                id="kode" placeholder="Masukan Kode" />
                                                                <span class="text-danger" id="kodeErrorMsg"></span>

                                                            </fieldset>

                                                        <fieldset class="form-group">
                                                            <label for="nama_in">Nama Indonesia</label>
                                                            <input type="text" name="nama_in"
                                                                value="{{ old('nama_in') }}"
                                                                class="form-control"
                                                                id="nama_in" placeholder="Masukan Nama Indonesia" />
                                                                <span class="text-danger" id="namaInErrorMsg"></span>

                                                        </fieldset>

                                                        <fieldset class="form-group">
                                                            <label for="nama_en">Nama English</label>
                                                            <input type="text" name="nama_en"
                                                                value="{{ old('nama_en') }}"
                                                                class="form-control"
                                                                id="nama_en" placeholder="Masukan Nama English" />
                                                                <span class="text-danger" id="namaEnErrorMsg"></span>

                                                            </fieldset>

                                                        <fieldset class="form-group">
                                                            <label for="nama_ch">Nama Mandarin</label>
                                                            <input type="text" name="nama_ch"
                                                                value="{{ old('nama_ch') }}"
                                                                class="form-control"
                                                                id="nama_ch" placeholder="Masukan Nama Mandarin" />
                                                                <span class="text-danger" id="namaChErrorMsg"></span>

                                                            </fieldset>

                                                        <fieldset class="form-group">
                                                            <label for="sks_teori">SKS Teori</label>
                                                            <input type="number" name="sks_teori"
                                                                value="{{ old('sks_teori') }}" id="sks_teori"
                                                                class="form-control"
                                                                placeholder="Masukan SKS Teori" />
                                                                <span class="text-danger" id="sksTeoriErrorMsg"></span>

                                                            </fieldset>
                                                    </div>

                                                    <div class="col-md-6">

                                                        <fieldset class="form-group">
                                                            <label for="sks_praktek">SKS Praktek</label>
                                                            <input type="number" name="sks_praktek"
                                                                value="{{ old('sks_praktek') }}" id="sks_praktek"
                                                                class="form-control"
                                                                placeholder="Masukan SKS Praktek" />
                                                                <span class="text-danger" id="sksPraktekErrorMsg"></span>
                                                            </fieldset>

                                                        <label for="golongan_fakultas">Fakultas</label>
                                                        <div class="form-group">
                                                            <select
                                                                class="select form-control"
                                                                id="golongan_fakultas" name="golongan_fakultas">
                                                                <option value="">Pilih</option>
                                                                @foreach ($fakultas as $fakultas)
                                                                <option value="{{ $fakultas->id }}">
                                                                    {{ $fakultas->nama_in }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger" id="golonganFakultasErrorMsg"></span>
                                                        </div>

                                                        <label for="golongan_prodi">Prodi</label>
                                                        <div class="form-group">
                                                            <select
                                                                class="select form-control"
                                                                id="golongan_prodi" name="golongan_prodi">
                                                                <option value="">Pilih</option>
                                                                @foreach ($prodi as $prodi)
                                                                <option value="{{ $prodi->id }}">
                                                                    {{ $prodi->nama_in }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger" id="golonganProdiErrorMsg"></span>
                                                        </div>

                                                        <label for="id_periode">Periode</label>
                                                        <div class="form-group">
                                                            <select
                                                                class="select form-control"
                                                                id="id_periode" name="id_periode">
                                                                <option value="">Pilih</option>
                                                                @foreach ($periode as $periode)
                                                                <option value="{{ $periode->kode }}">
                                                                    {{ $periode->nama_periode }}</option>

                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger" id="idPeriodeErrorMsg"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('matakuliah.index') }}" type="button"
                                                class="btn btn-light-secondary" data-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Close</span>
                                            </a>
                                            <button type="submit" id="tombol-simpan" value="create" class="btn btn-primary ml-1">
                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Simpan</span>
                                            </button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--Akhir form Modal -->

                            <!--Mulai form Modal Show Archived -->
                            <div class="modal fade text-left" id="show-archived" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="myModalLabel1">Data Arsip</h3>
                                            <button type="button" class="close rounded-pill" data-dismiss="modal"
                                                aria-label="Close">
                                                <i class="bx bx-x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Akhir form Modal Archived -->

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
        var table = $('#table_matakuliah').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('matakuliah.index') }}",
            columns: [
                {data: null,sortable:false,
                    render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1 + '.';
                    }
                }, 
                {data: 'kode',name: 'kode'},
                {data: 'nama_in', name: 'nama_in'},
                {data: 'nama_prodi', name: 'nama_prodi'},
                {data: 'nama_periode',name: 'nama_periode'},
                {data: 'action',name: 'action'},
            ]
        });
    });

    //TOMBOL TAMBAH DATA
    $('#tombol-tambah').click(function () {
        $('#button-simpan').val("create-post");
        $('#id').val('');
        $('#form-tambah-edit').trigger("reset");
        $('#modal-judul').html("Form Tambah Matakuliah");
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
                    url: "{{ route('matakuliah.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#form-tambah-edit').trigger("reset");
                        $('#tambah-edit-modal').modal('hide');
                        $('#tombol-simpan').html('Save');
                        $('#table_matakuliah').DataTable().ajax.reload(null, true);
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
                    error: function(response) {
                        $('#kodeErrorMsg').text(response.responseJSON.errors.kode);
                        $('#namaIDErrorMsg').text(response.responseJSON.errors.nama_id);
                        $('#sksTeoriErrorMsg').text(response.responseJSON.errors.sks_teori);
                        $('#sksPraktekErrorMsg').text(response.responseJSON.errors.sks_praktek);
                        $('#golFakultasErrorMsg').text(response.responseJSON.errors.golongan_fakultas);
                        $('#golProdiErrorMsg').text(response.responseJSON.errors.golongan_prodi);
                        $('#idPeriodeErrorMsg').text(response.responseJSON.errors.id_periode);
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
        var data_id = $(this).data('kode');
        $.get('matakuliah/' + data_id + '/edit', function (data) {
            $('#modal-judul').html("Form Edit Matakuliah");
            $('#tombol-simpan').val("edit-post");
            $('#tambah-edit-modal').modal('show');
            
            $('#kode').val(data.kode);
            $('#nama_in').val(data.nama_in);
            $('#nama_en').val(data.nama_en);
            $('#nama_ch').val(data.nama_ch);
            $('#sks_teori').val(data.sks_teori);
            $('#sks_praktek').val(data.sks_praktek);
            $('#golongan_fakultas').val(data.golongan_fakultas);
            $('#golongan_prodi').val(data.golongan_prodi);
            $('#id_periode').val(data.id_periode);
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
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        url: "matakuliah/" + dataId,
                        type: 'DELETE',
                        data: {id:dataId},
                        dataType: 'json'
                    }).done(function(response) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Your data has been deleted.',
                            type: 'success',
                            timer: 2000
                        })
                        $('#table_matakuliah').DataTable().ajax.reload(null, true);
                    }).fail(function() {
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
