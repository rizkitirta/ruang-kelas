@extends('layout')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
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
            <h2 class="section-title">Hi, {{ Auth::user()->name }}!</h2>
            {{-- <p class="section-lead">
            Change information about yourself on this page.
        </p> --}}

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            @php
                                $file = Auth::user()->profile;
                                $src = isset($file->foto) ? explode('/', $file->foto) : '';
                            @endphp
                            {{-- @dd($src) --}}
                            <img alt="image"
                                src="{{ !empty($src) ? "/storage/uploads/$src[2]" : asset('assets/img/avatar/avatar-1.png') }}"
                                class="rounded-circle profile-widget-picture">
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name">{{ Auth::user()->name }} <div
                                    class="text-muted d-inline font-weight-normal">
                                    <div class="slash"></div> {{ isset(Auth::user()->profile->jabatan) ? Auth::user()->profile->jabatan : ''}}
                                </div>
                            </div>
                            {{ Auth::user()->name }} is a superhero name in <b>Indonesia</b>, especially in my family. He
                            is
                            not a
                            fictional character but an original hero in my family, a hero for his children and for his
                            wife. So, I use the name as a user in this template. Not a tribute, I'm just bored with
                            <b>'John Doe'</b>.
                        </div>
                        <div class="card-footer text-center">
                            {{-- <div class="font-weight-bold mb-2">Follow Me</div> --}}
                            <a href="#" class="btn btn-social-icon btn-facebook mr-1">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="btn btn-social-icon btn-twitter mr-1">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="btn btn-social-icon btn-github mr-1">
                                <i class="fab fa-github"></i>
                            </a>
                            <a href="#" class="btn btn-social-icon btn-instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form method="post" class="needs-validation" novalidate="" action="{{ route('profile.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->name }}"
                                            required="" name="name">
                                        <div class="invalid-feedback">
                                            Please fill in the first name
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>No Identitas</label>
                                        <input type="text" class="form-control"
                                            value="{{ isset(Auth::user()->profile->no_identitas) ? Auth::user()->profile->no_identitas : '' }}" required=""
                                            name="no_identitas">
                                        <div class="invalid-feedback">
                                            Please fill in the last name
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-7 col-12">
                                        <label>Email</label>
                                        <input type="email" class="form-control" value="{{ Auth::user()->email }}"
                                            required="" name="email">
                                        <div class="invalid-feedback">
                                            Please fill in the email
                                        </div>
                                    </div>
                                    <div class="form-group col-md-5 col-12">
                                        <label>Phone</label>
                                        <input type="text" class="form-control"
                                            value="{{ isset(Auth::user()->profile->no_hp) ? Auth::user()->profile->no_hp : '' }}" name="no_hp">
                                    </div>
                                    <div class="form-group col-md-5 col-12">
                                        <label>Foto</label>
                                        <input type="file" class="form-control"
                                            value="{{ isset(Auth::user()->profile->foto) ? Auth::user()->profile->foto : '' }}" name="foto">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
