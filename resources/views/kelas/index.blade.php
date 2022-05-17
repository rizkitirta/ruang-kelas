@extends('layout')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Kelas</h1>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="section-body">
            <div class="col-12 col-md-12 mb-4">
                <div class="hero bg-primary text-white">
                    <div class="hero-inner">
                        <h2>{{ $data->nama_kelas }}</h2>
                        <p class="lead">{{ $data->mapel }} | Kelas {{ $data->bagian }}</p>
                        <div class="mt-4">
                            <a href="#" class="btn btn-outline-white btn-lg btn-icon icon-left"><i
                                    class="far fa-user"></i>
                                {{ $data->user->name }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4></h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab"
                                aria-controls="home" aria-selected="true">Anggota</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab"
                                aria-controls="profile" aria-selected="false">Tugas</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent2">
                        <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                            <div class="row ">
                                <div class="col-md-2">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Kode Kelas</h4>
                                        </div>
                                        <div class="card-body">
                                            <h3 class="text-bold">{{ $data->kode_kelas }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Anggota Kelas</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped" id="table_anggota">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">
                                                                    #
                                                                </th>
                                                                <th>Nama</th>
                                                                <th>Email</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">

                            <div class="col-12 col-md-12 col-lg-12 mt-5">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="mr-3">List Tugas</h4>
                                        @if (Auth::user()->id == $data->user_id)
                                            <button class="btn btn-primary mb-5 buat_tugas mt-5 float-right">Buat
                                                Tugas</button>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <div id="accordion">
                                            @foreach ($tugas as $key => $tgs)
                                                <div class="accordion">
                                                    <div class="accordion-header" role="button" data-toggle="collapse"
                                                        data-target="#panel-body-{{ $tgs->id }}" aria-expanded="true">
                                                        <h4>{{ $tgs->judul }}</h4>
                                                    </div>
                                                    <div class="accordion-body collapse {{ $key == 0 ? 'show' : '' }}"
                                                        id="panel-body-{{ $tgs->id }}" data-parent="#accordion">
                                                        <p class="mb-0">{{ $tgs->deskripsi }}</p>
                                                        <a href="{{ route('tugas.show', $tgs->id) }}"
                                                            class="btn btn-primary">lihat tugas</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <div class="modal fade" tabindex="-1" role="dialog" id="modal-tugas">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('tugas.store') }}" id="form_tugas" enctype="multipart/form-data" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Buat Tugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" class="form-control" name="kelas_id" id="kelas_id"
                            value="{{ $data->id }}">
                        <div class="form-group">
                            <label>Judul*</label>
                            <input type="text" class="form-control" placeholder="example: MIPA 1" name="judul" id="judul">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" placeholder="Deskripsi Tugas" name="deskripsi" id="deskripsi" id="" cols="30"
                                rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label>File</label>
                            <input type="file" class="form-control" name="file" id="file">
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn_buat">Buat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('after-script')
    <script>
        $('.buat_tugas').click(function(e) {
            e.preventDefault();
            $('#modal-tugas').modal('show')
        });

        // $('#btn_buat').click(function(e) {
        //     e.preventDefault();
        //     var form = new FormData()
        //     form.append('judul', $('#judul').val())
        //     form.append('deskripsi', $('#deskripsi').val())
        //     form.append('file', $('#file').val())
        //     // form.append('_token', "{{ csrf_token() }}")
        //     form.append('kelas_id', "{{ $data->id }}")
        //     console.log(form)
        //     $.ajax({
        //         type: "POST",
        //         url: "{{ route('tugas.store') }}",
        //         data: {form,_token : "{!! csrf_token() !!}"},
        //         cache:false,
        //         contentType: false,
        //         processData: false,
        //         success: function (res) {
        //             alert(res,message)
        //             $('#modal-tugas').modal('hide')
        //             $('#form_tugas').reset()
        //         }
        //     });
        // });

        $(document).ready(function() {
            getDatatable()
        });

        // Table
        const getDatatable = () => {
            $('#table_anggota').DataTable().destroy();
            $('#table_anggota').DataTable({
                serverSide: true,
                processing: true,
                "lengthMenu": [
                    [50, 100, -1],
                    [50, 100, "All"]
                ],
                ajax: {
                    type: 'GET',
                    url: "{{ route('kelas.index') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        kelas_id: "{{ $data->id }}"
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name',
                    },
                    {
                        data: 'user.email',
                        name: 'user.email',
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            let pemilik = "{{ $data->user_id }}"
                            let auth = "{{ auth()->id() }}"
                            if (auth == pemilik) {
                                return ` <div class="btn-group">
                                            <button class="btn btn-danger btn-sm btn_kick round" id="btn_kick" value="${row.user.id}" title="Hapus data">
                                                keluarkan
                                            </button>
                                        </div>`;
                            }

                            return '-'
                        }
                    },
                ]
            })
        }


        $(document).on('click', '#btn_kick', function(e) {
            e.preventDefault();
            if (confirm("Keluarkan Anggota Ini?")) {
                let user_id = $(this).val()
                $.ajax({
                    type: "POST",
                    url: "{{ route('kelas.anggota.hapus') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        user_id,
                        kelas_id: "{{ $data->id }}"
                    },
                    success: function(res) {
                        iziToast.success({
                            title: 'Berhasil!',
                            message: res.message,
                            position: 'topRight'
                        });
                        getDatatable()
                    }
                });
            }

        });
    </script>
@endpush
