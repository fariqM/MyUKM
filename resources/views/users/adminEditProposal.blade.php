@extends('layouts.app', ['page' => __('EditProposal'), 'pageSlug' => 'TabelPengajuan'])

@section('before-css')
<link rel="stylesheet" href="{{asset('assets/styles/vendor/dropzone.min.css')}}">


@endsection
@section('admin-css')


<link rel="stylesheet" href="{{asset('assets/styles/vendor/ladda-themeless.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.date.css')}}">

@endsection

@section('content')

<div class="row">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Proposal</h4>
                <div class="card-body">


                    {{-- <button id="button-select" class="btn btn-primary mb-1">select files</button>
                    <form action="#" method="POST" class="dropzone dropzone-area" enctype="multipart/form-data" id="button-select-upload">
                        @csrf

                        <div class="fallback">
                            <input type="file" name="file" />
                        </div>
                        <div class="dz-message">Drop Files Here To Upload</div>
                    </form> --}}

                    {{-- <form action="/file-upload" class="dropzone" id="my-awesome-dropzone"><input type="file"
                        name="file" />
                    </form> --}}

                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <h5>Upload / Drag file ke kolom di bawah ini</h5>
                            <form action="#" class="dropzone">
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
                            </form>
                        </blockquote>
                    </div>


                </div>
                <form action="/adminTable/Pengajuan/{{ $proposal->name }}/edit" method="post" class="needs-validation"
                    enctype="multipart/form-data" novalidate>
                    @csrf



                    <div class="form-group">
                        <label for="judul">Judul Proposal</label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror "
                            placeholder="Judul Proposal" value="{{ old('judul') ?? $proposal->judul }}" required>
                        @error('judul')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="mulai">Mulai</label>
                        <input type="time" name="mulai" autofocus
                            class="datepicker form-control @error('mulai') is-invalid @enderror col-lg-4 "
                            value="{{ old('mulai') ?? $proposal->mulai }}" required>
                        @error('mulai')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="selesai">Selesai</label>
                        <input type="time" name="selesai" autofocus
                            class="datepicker form-control @error('selesai') is-invalid @enderror col-lg-4"
                            value="{{ old('selesai') ?? $proposal->selesai }}" required>
                        @error('selesai')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input style=" cursor: pointer; color: #00EFC4; " id="picker3"
                            class="datepicker form-control @error('tanggal') is-invalid @enderror col-lg-4"
                            placeholder="yyyy-mm-dd" name="tanggal" value="{{ old('tanggal') ?? $proposal->tanggal }}">
                        @error('tanggal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tempat">Tempat</label>
                        <input type="text" name="tempat" class="form-control @error('tempat') is-invalid @enderror"
                            placeholder="Judul Proposal" value="{{ old('tempat') ?? $proposal->tempat }}" required>
                        @error('tempat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="PenanggungJawab">Penanggung Jawab</label>
                        <input type="text" name="PenanggungJawab"
                            class="form-control @error('PenanggungJawab') is-invalid @enderror" placeholder="Judul Proposal"
                            value="{{ old('PenanggungJawab') ?? $proposal->PenanggungJawab }}" required>
                        @error('PenanggungJawab')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">

                        <button class="btn btn-success animation-on-hover" type="submit">Simpan</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


@section('page-js')
<script src="{{asset('assets/js/vendor/dropzone.min.js')}}"></script>
<script src="{{asset('assets/js/dropzone.script.js')}}"></script>
@endsection

@section('bottom-js')
<script src="{{asset('assets/js/vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('assets/js/vendor/pickadate/picker.time.js')}}"></script>
<script src="{{asset('assets/js/vendor/pickadate/picker.date.js')}}"></script>
<script src="{{asset('assets/js/form.basic.script.js')}}"></script>
@include('sweetalert::alert')
@endsection