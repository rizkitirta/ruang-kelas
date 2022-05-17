@extends('layout')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Tugas</h1>
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

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tugas</h4>
                </div>
                <div class="card-body">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <article class="article">
                            <div class="article-header">
                                <div class="article-image" data-background="{{ asset('assets/img/news/img08.jpg') }}">
                                </div>
                                <div class="article-title">
                                    <h2><a href="#">{{ $data->judul }}</a></h2>
                                </div>
                            </div>
                            <div class="article-details">
                                <p>{{ $data->deskripsi }}</p>
                                <div class="article-cta">
                                    <a target="_blank" href="{{ url('/storage/uploads') . '/' . $fileName }}"
                                        class="btn btn-primary {{ is_null($data->file) ? 'disabled' : '' }}">Lihat
                                        Soal
                                        Tugas</a>
                                    @if (Auth::id() != $data->kelas->user_id)
                                        <a href="" class="btn btn-primary btn_kumpul">Kumpul Tugas</a>
                                    @endif
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>List Anggota Yang Sudah Mengumpulkan Tugas</h4>
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
                                    <th>Status</th>
                                    <th>Nilai</th>
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

    </section>

    <div class="modal fade" tabindex="-1" role="dialog" id="modal-tugas">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('tugas.kumpul') }}" id="form_tugas" enctype="multipart/form-data" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Kumpul Tugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" class="form-control" name="tugas_id" id="tugas_id"
                            value="{{ $data->id }}">
                        <div class="form-group">
                            <label>File</label>
                            <input type="file" class="form-control" name="file" id="file">
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn_kumpul_act">Kumpul</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modal-nilai">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" id="form_tugas" enctype="multipart/form-data" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Nilai Tugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" class="form-control" name="tugas_id" id="tugas_id"
                            value="{{ $data->id }}">
                        <input type="hidden" class="form-control" name="user_id" id="user_id_nilai" value="">
                        <div class="form-group">
                            <label>Nilai</label>
                            <input type="number" placeholder="example: 100" class="form-control" name="nilai" id="nilai">
                        </div>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Selesai</option>
                            <option value="0">Pending</option>
                        </select>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btn_nilai_act">Nilai</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('after-script')
    <script>
        $('.btn_kumpul').click(function(e) {
            e.preventDefault();
            $('#modal-tugas').modal('show')
        });

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
                    url: "{{ route('tugas.index') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        tugas_id: "{{ $data->id }}"
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'user.name',
                        name: 'user.name',
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            return `<div class="badge badge-${row.status == 0 ? 'secondary' : 'success'}">${row.status == 0 ? 'Pending' : 'Selesai'}</div>`
                        }
                    },
                    {
                        data: 'nilai',
                        name: 'nilai',

                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            let src = row.file.split('/')
                            let pemilik = "{{ $data->kelas->user_id }}"
                            let auth = "{{ auth()->id() }}"
                            let checkPemilik = pemilik == auth ? true : false
                            return ` <div class="btn-group">
                                        <a target="_blank" href="{{ asset('/storage/uploads') }}/${src[2]}" class="btn btn-primary btn-sm btn_delete round ${auth == row.user_id ? '' : auth == pemilik ? '' : 'disabled'}" title="Lihat">
                                            Lihat Tugas
                                        </a>
                                        ${checkPemilik ? `<button onClick="showModalNilai(${row.user_id})" class="btn btn-primary btn-sm btn_nilai round" title="Lihat">
                                                        Nilai
                                                    </button>` : ''}

                                    </div>`
                        }
                    },
                ]
            })
        }

        const showModalNilai = (userId) => {
            $('#modal-nilai').modal('show')
            $('#user_id_nilai').val(userId)
        }

        $(document).on('click', '#btn_nilai_act', function(e) {
            e.preventDefault();
            let user_id = $(this).val()
            $.ajax({
                type: "POST",
                url: "{{ route('tugas.nilai') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    nilai: $('#nilai').val(),
                    status: $('#status').val(),
                    tugas_id: "{{ $data->id }}",
                    user_id: $('#user_id_nilai').val()
                },
                success: function(res) {
                    alert(res.message)
                    $('#modal-nilai').modal('hide')
                    getDatatable()
                }
            });
        });
    </script>
@endpush
