@extends('layout')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Kelas</h1>
        </div>

        <div class="section-body">
            <div class="col-12 col-md-12 mb-4">
                <div class="hero bg-primary text-white">
                    <div class="hero-inner">
                        <h2>{{ $data->nama_kelas }}</h2>
                        <p class="lead">{{ $data->mapel }}</p>
                        <div class="mt-4">
                            <a href="#" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-user"></i>
                                Setup Account</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Tab <code>.nav-pills</code></h4>
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
                                                <h4>Basic DataTables</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped" id="table-1">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">
                                                                    #
                                                                </th>
                                                                <th>Task Name</th>
                                                                <th>Progress</th>
                                                                <th>Members</th>
                                                                <th>Due Date</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    1
                                                                </td>
                                                                <td>Create a mobile app</td>
                                                                <td class="align-middle">
                                                                    <div class="progress" data-height="4"
                                                                        data-toggle="tooltip" title="100%">
                                                                        <div class="progress-bar bg-success"
                                                                            data-width="100%"></div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <img alt="image" src="assets/img/avatar/avatar-5.png"
                                                                        class="rounded-circle" width="35"
                                                                        data-toggle="tooltip" title="Wildan Ahdian">
                                                                </td>
                                                                <td>2018-01-20</td>
                                                                <td>
                                                                    <div class="badge badge-success">Completed</div>
                                                                </td>
                                                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    2
                                                                </td>
                                                                <td>Redesign homepage</td>
                                                                <td class="align-middle">
                                                                    <div class="progress" data-height="4"
                                                                        data-toggle="tooltip" title="0%">
                                                                        <div class="progress-bar" data-width="0"></div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <img alt="image" src="assets/img/avatar/avatar-1.png"
                                                                        class="rounded-circle" width="35"
                                                                        data-toggle="tooltip" title="Nur Alpiana">
                                                                    <img alt="image" src="assets/img/avatar/avatar-3.png"
                                                                        class="rounded-circle" width="35"
                                                                        data-toggle="tooltip" title="Hariono Yusup">
                                                                    <img alt="image" src="assets/img/avatar/avatar-4.png"
                                                                        class="rounded-circle" width="35"
                                                                        data-toggle="tooltip" title="Bagus Dwi Cahya">
                                                                </td>
                                                                <td>2018-04-10</td>
                                                                <td>
                                                                    <div class="badge badge-info">Todo</div>
                                                                </td>
                                                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    3
                                                                </td>
                                                                <td>Backup database</td>
                                                                <td class="align-middle">
                                                                    <div class="progress" data-height="4"
                                                                        data-toggle="tooltip" title="70%">
                                                                        <div class="progress-bar bg-warning"
                                                                            data-width="70%"></div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <img alt="image" src="assets/img/avatar/avatar-1.png"
                                                                        class="rounded-circle" width="35"
                                                                        data-toggle="tooltip" title="Rizal Fakhri">
                                                                    <img alt="image" src="assets/img/avatar/avatar-2.png"
                                                                        class="rounded-circle" width="35"
                                                                        data-toggle="tooltip" title="Hasan Basri">
                                                                </td>
                                                                <td>2018-01-29</td>
                                                                <td>
                                                                    <div class="badge badge-warning">In Progress</div>
                                                                </td>
                                                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    4
                                                                </td>
                                                                <td>Input data</td>
                                                                <td class="align-middle">
                                                                    <div class="progress" data-height="4"
                                                                        data-toggle="tooltip" title="100%">
                                                                        <div class="progress-bar bg-success"
                                                                            data-width="100%"></div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <img alt="image" src="assets/img/avatar/avatar-2.png"
                                                                        class="rounded-circle" width="35"
                                                                        data-toggle="tooltip" title="Rizal Fakhri">
                                                                    <img alt="image" src="assets/img/avatar/avatar-5.png"
                                                                        class="rounded-circle" width="35"
                                                                        data-toggle="tooltip" title="Isnap Kiswandi">
                                                                    <img alt="image" src="assets/img/avatar/avatar-4.png"
                                                                        class="rounded-circle" width="35"
                                                                        data-toggle="tooltip" title="Yudi Nawawi">
                                                                    <img alt="image" src="assets/img/avatar/avatar-1.png"
                                                                        class="rounded-circle" width="35"
                                                                        data-toggle="tooltip" title="Khaerul Anwar">
                                                                </td>
                                                                <td>2018-01-16</td>
                                                                <td>
                                                                    <div class="badge badge-success">Completed</div>
                                                                </td>
                                                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                                            </tr>
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
                            <button class="btn btn-primary mb-5 buat_tugas">Buat Kelas</button>
                            Sed sed metus vel lacus hendrerit tempus. Sed efficitur velit tortor, ac efficitur est lobortis
                            quis. Nullam lacinia metus erat, sed fermentum justo rutrum ultrices. Proin quis iaculis tellus.
                            Etiam ac vehicula eros, pharetra consectetur dui.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <div class="modal fade" tabindex="-1" role="dialog" id="modal-kelas">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buat Tugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="form_kelas">
                        <div class="form-group">
                            <label>Judul*</label>
                            <input type="text" class="form-control" placeholder="example: MIPA 1" name="judul"
                                id="judul">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea  class="form-control" placeholder="Deskripsi Tugas" name="deskripsi" id="deskripsi" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label>File</label>
                            <input type="file" class="form-control" name="file"
                                id="file">
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn_buat">Buat</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-script')
    <script>
        $('.buat_tugas').click(function(e) {
            e.preventDefault();
            $('#modal-kelas').modal('show')
        });

        $('#btn_buat').click(function(e) {
            e.preventDefault();
            let form = new FormData()
            form.append('judul',$('#judul').val())
            form.append('deskripsi',$('#deskripsi').val())
            form.append('file',$('#file').val())
            $.ajax({
                type: "POST",
                url: "{{ route('tugas.store') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    form
                },
                success: function(res) {
                    alert(res.message)
                    $('#modal-kelas').modal('hide')
                    window.location.reload();
                }
            });
        });
    </script>
@endpush
