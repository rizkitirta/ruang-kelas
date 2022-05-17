@extends('layout')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Kelas</h1>
        </div>

        <div class="my-5 p-5">
            <button class="btn btn-primary my-4 buat_kelas float-right">Buat Kelas</button>
            <div class="row justify-content-between">
                <div class="col-md-6">
                </div>
                <div class="col-md-8">
                    <form action="{{ route('dashboard.index') }}" method="GET">
                        <div class="form-group">
                            <label for="">Kode kelas</label>
                            <input type="text" class="form-control" placeholder="example : KXIJB4SFMI" name="kode_kelas">
                        </div>
                        <button type="submit" class="btn btn-info float-left">Cari Kode</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                @foreach ($data as $item)
                    <a href="{{ route('kelas.detail', $item->id) }}">
                        <div class="col-12 col-md-4 col-lg-4" id="element_kelas_{{ $item->id }}">
                            <article class="article article-style-c">
                                <div class="article-header">
                                    <div class="article-image"
                                        data-background="{{ asset('assets/img/news/img13.jpg') }}">
                                    </div>
                                </div>
                                <div class="article-details">
                                    {{-- <div class="article-category"><a href="#"></a>
                                        <div class="bullet"></div> <a
                                            href="#">{{ $item->created_at->diffForHumans() }}</a>
                                    </div> --}}
                                    <h5 class="d-inline ">{{ $item->kode_kelas }}</h5>
                                    <div class="bullet float-right"></div> <a href="#"
                                        class="float-right ">{{ $item->created_at->diffForHumans() }}</a>
                                    <div class="article-title">
                                        <h2><a href="{{ route('kelas.detail', $item->id) }}" class="text-dark"
                                                id="btn_href_{{ $item->id }}">{{ $item->nama_kelas }}</a>
                                        </h2>
                                    </div>
                                    <p>{{ $item->mapel }} | Kelas {{$item->bagian}}</p>
                                    <div class="article-user">
                                        <div class="article-user-details row">
                                            <div class="col-md-8">
                                                <div class="container">
                                                    <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}">
                                                    <div class="user-detail-name">
                                                        <a href="#">{{ $item->user->name }}</a>
                                                    </div>
                                                    <div class="is-online mt-1"></div>
                                                    <div class="text-job d-inline ml-2 text-light ">Online</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                @if (Auth::user()->id != $item->user_id && !Auth::guest())
                                                    <button class="btn btn-primary mb-5 gabung_kelas float-right d-inline"
                                                        value="{{ $item->id }}">Gabung</button>
                                                @else
                                                    <button class="btn btn-danger mb-5 hapus_kelas float-right d-inline"
                                                        value="{{ $item->id }}">Hapus</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-kelas">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buat Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="form_kelas">
                        <div class="form-group">
                            <label>Nama kelas*</label>
                            <input type="text" class="form-control" placeholder="example: MIPA 1" name="nama_kelas"
                                id="nama_kelas">
                        </div>
                        <div class="form-group">
                            <label>Kelas</label>
                            <input type="text" class="form-control" placeholder="" name="kelas" id="kelas">
                        </div>
                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <input type="text" class="form-control" placeholder="example: Bahasa Indonesia" name="mapel"
                                id="mapel">
                        </div>
                        <div class="form-group">
                            <label>Ruangan</label>
                            <input type="text" class="form-control" placeholder="example: Kelas X MIPA 1" name="ruang"
                                id="ruang">
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
        $('.buat_kelas').click(function(e) {
            e.preventDefault();
            $('#modal-kelas').modal('show')
        });

        $('#btn_buat').click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ route('kelas.store') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    nama_kelas: $('#nama_kelas').val(),
                    bagian: $('#bagian').val(),
                    mapel: $('#mapel').val(),
                    ruang: $('#ruang').val(),
                    kelas: $('#kelas').val(),
                },
                success: function(res) {
                    iziToast.success({
                        title: 'Berhasil!',
                        message: res.message,
                        position: 'topRight'
                    });
                    $('#modal-kelas').modal('hide')
                    window.location.reload();
                }
            });
        });

        $('.gabung_kelas').click(function(e) {
            e.preventDefault();
            let kelas_id = $(this).val()
            $.ajax({
                type: "POST",
                url: "{{ route('kelas.gabung') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    kelas_id
                },
                success: function(res) {
                    iziToast.success({
                        title: 'Berhasil!',
                        message: res.message,
                        position: 'topRight'
                    });
                }
            });
        });

        $('.hapus_kelas').click(function(e) {
            e.preventDefault();
            if (confirm("Hapus Kelas Ini?")) {
                let kelas_id = $(this).val()
                $.ajax({
                    type: "POST",
                    url: "{{ route('kelas.hapus') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        kelas_id
                    },
                    success: function(res) {
                        iziToast.success({
                            title: 'Berhasil!',
                            message: res.message,
                            position: 'topRight'
                        });
                        if (res.status) {
                            $(`#element_kelas_${kelas_id}`).remove();
                        }
                    }
                });
            }
        });
    </script>
@endpush
