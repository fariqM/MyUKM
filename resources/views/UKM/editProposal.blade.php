@extends('UKM.layouts.master')


@section('before-css')
<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.date.css')}}">



@endsection
@section('page-css')
<link rel="stylesheet" href="{{asset('assets/styles/vendor/dropzone.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/ladda-themeless.min.css')}}">




@endsection

@section('main-content')


<div class="breadcrumb">
    <h1>Layanan</h1>
    <ul>

        <li>Pengajuan Proposal</li>
    </ul>
</div>


<div class="separator-breadcrumb border-top"></div>

<div class="container">
    <div class="row">
        <div class="col-lg-9">

            <div class="card mb-5">
                <div class="card-header">
                    <h4 class="">Perhatian!! Proposal yang di-upload akan mengganti file proposal lama.
                    </h4>
                </div>
                <form action="/dokumen/{{ $proposal->slug }}/edit/proposal" method="POST" class="dropzone"
                    id="multple-file-upload" enctype="multipart/form-data">
                    @csrf
                    <div class="fallback">
                        <input type="file" name="file" />
                    </div>
                </form>


                <form action="/dokumen/{{ encrypt($proposal->slug) }}/edit" method="post" class="needs-validation"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="row row-xs">
                            <div class="col-sm-3">
                                <label for="firstName1">Judul Proposal</label>
                            </div>
                            <div class="col-lg">
                                <input type="text" name="judul"
                                    class="form-control  @error('judul') is-invalid @enderror "
                                    placeholder="Masukkan judul proposal" placeholder="Masukkan judul proposal"
                                    value="{{ old('judul') ?? $proposal->judul }}" required>
                                @error('judul')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row row-xs">
                            <div class="col-sm-3">
                                <label for="firstName1">Waktu Mulai Acara</label>
                            </div>
                            <div class="col-lg-3">
                                <input id="input_from" name="mulai"
                                    class="datepicker form-control  @error('mulai') is-invalid @enderror"
                                    value="{{ old('mulai') ?? $proposal->mulai }}" type="time" autofocus>
                                @error('mulai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row row-xs">
                            <div class="col-sm-3">
                                <label for="firstName1">Waktu Selesai Acara</label>
                            </div>
                            <div class="col-lg-3">
                                <input id="input_from" name="selesai"
                                    class="datepicker form-control  @error('selesai') is-invalid @enderror" type="time"
                                    name="time" value="{{ old('selesai') ?? $proposal->selesai }}" autofocus required>
                                @error('mulai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row row-xs">
                            <div class="col-sm-3">
                                <label for="firstName1">Tanggal</label>
                            </div>
                            <div class="col-lg">
                                <input id="picker3" class="form-control " placeholder="yyyy-mm-dd"
                                    value="{{ old('tanggal') ?? date_format(date_create($proposal->tanggal),"d F Y") }}" name="tanggal" required>
                                @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row row-xs">
                            <div class="col-sm-3">
                                <label for="firstName1">Tempat</label>
                            </div>
                            <div class="col-lg">
                                <input type="text" name="tempat"
                                    class="form-control  @error('judul') is-invalid @enderror"
                                    placeholder="Masukkan Tempat yang berhubungan"
                                    value="{{ old('tempat') ?? $proposal->tempat }}" required>
                                @error('tempat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row row-xs">
                            <div class="col-sm-3">
                                <label for="firstName1">Penanggung Jawab</label>
                            </div>
                            <div class="col-lg">
                                <input type="text" name="PenanggungJawab"
                                    class="form-control  @error('judul') is-invalid @enderror"
                                    placeholder="Masukkan Nama Penanggung Jawab"
                                    value="{{ old('PenanggungJawab') ?? $proposal->PenanggungJawab }}" required>
                                @error('PenanggungJawab')

                                <div class="invalid-feedback">
                                    {{ "Kolom Penanggung Jawab Harus Terisi" }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="d-flex justify-contet-between">
                            <button type="submit" class="btn btn-primary btn-lg ripple m-1"
                                data-style="expand-left">Submit</button>
                        </div>

                    </div>
                </form>
            </div>

        </div>

    </div>
</div>



@endsection

@section('page-js')
<script>
    
    $(document).ready(function(){
            $('#dropdownNotification').click(function(){
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url:"{{url('/notif/update')}}", 
                    type: "POST",
                    success: function(){
                       
                    }
                });
            }); 
    });

</script>
<script src="{{asset('assets/js/vendor/dropzone.min.js')}}"></script>

<script src="{{asset('assets/js/dropzone.script.js')}}"></script>

<script src="{{asset('assets/js/vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('assets/js/vendor/pickadate/picker.time.js')}}"></script>
<script src="{{asset('assets/js/vendor/pickadate/picker.date.js')}}"></script>

@endsection

@section('bottom-js')
<script src="{{asset('assets/js/form.validation.script.js')}}"></script>
<script src="{{asset('assets/js/form.basic.script.js')}}"></script>
@include('sweetalert::alert')

@endsection