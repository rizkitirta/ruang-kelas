@extends('layout')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Kelas</h1>
        </div>

        <button class="btn btn-primary mb-5 buat_kelas">Buat Kelas</button>

        <div class="section-body">
            <div class="row">
                @foreach ($data as $item)
                    <div class="col-12 col-md-4 col-lg-4">
                        <article class="article article-style-c">
                            <div class="article-header">
                                <div class="article-image" data-background="{{ asset('assets/img/news/img13.jpg') }}">
                                </div>
                            </div>
                            <div class="article-details">
                                <div class="article-category"><a href="#">{{ $item->kode_kelas }}</a>
                                    <div class="bullet"></div> <a
                                        href="#">{{ $item->created_at->diffForHumans() }}</a>
                                </div>
                                <div class="article-title">
                                    <h2><a href="{{route('kelas.detail',$item->id)}}">{{ $item->nama_kelas }}</a></h2>
                                </div>
                                <p>{{ $item->mapel }}</p>
                                <div class="article-user">
                                    <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}">
                                    <div class="article-user-details">
                                        <div class="user-detail-name">
                                            <a href="#">{{ auth()->user()->name }}</a>
                                        </div>
                                        <div class="is-online mt-1"></div>
                                        <div class="text-job d-inline ml-2 text-light ">Online</div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
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
                            <label>Bagian</label>
                            <input type="text" class="form-control" placeholder="" name="bagian" id="bagian">
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
