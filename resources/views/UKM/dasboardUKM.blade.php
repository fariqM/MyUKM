@extends('UKM.layouts.master')


@section('before-css')
<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.date.css')}}">
@endsection

@section('page-css')
<link rel="stylesheet" href="{{asset('assets/styles/vendor/toastr.css')}}">
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
                    <div class="card-title">
                        <h4>Upload Proposal</h4>
                    </div>
                </div>
                <form action="/MyUKM/store" method="post" class="needs-validation" enctype="multipart/form-data"
                    novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="row row-xs">
                            <div class="col-sm-3">
                                <label for="firstName1">Judul Proposal</label>
                            </div>
                            <div class="col-lg">
                                <input type="text" name="judul"
                                    class="form-control @error('judul') is-invalid @enderror "
                                    value="{{ old('judul') }}" placeholder="Masukkan judul proposal" required>
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
                                    class="datepicker form-control @error('mulai') is-invalid @enderror"
                                    value="{{ old('mulai') }}" type="time" name="time" autofocus required>
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
                                <input id="input_from" name="selesai" class="datepicker form-control"
                                    value="{{ old('selesai') }}" type="time" name="time" autofocus required>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row row-xs">
                            <div class="col-sm-3">
                                <label for="firstName1">Tanggal</label>
                            </div>
                            <div class="col-lg">
                                <input id="picker3" class="form-control @error('tanggal') is-invalid @enderror"
                                    placeholder="yyyy-mm-dd" name="tanggal" value="{{ old('tanggal') }}" required>
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
                                    class="form-control @error('tempat') is-invalid @enderror "
                                    value="{{ old('tempat') }}" placeholder="Masukkan Tempat yang berhubungan" required>
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
                                    class="form-control @error('PenanggungJawab') is-invalid @enderror "
                                    value="{{ old('PenanggungJawab') }}" placeholder="Masukkan Nama Penanggung Jawab"
                                    required>
                                @error('PenanggungJawab')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <h5>File proposal harus berformat PDF atau Docs. selain itu maka tidak akan tersimpan ke server
                        </h5>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="inputGroupFile01"
                                    aria-describedby="inputGroupFileAddon01" required>
                                <label class="custom-file-label" for="inputGroupFile01">
                                    <p id="p1">Pilih File</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="col-md-12">
                            <button class="btn btn-primary">Submit</button>
                        </div>

                    </div>
                </form>
            </div>

        </div>

    </div>
</div>



@endsection

@section('page-js')
<script src="{{asset('assets/js/vendor/toastr.min.js')}}"></script>
<script src="{{asset('assets/js/toastr.script.js')}}"></script>

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

<script>
    $(document).ready(function(){
        var users = @json($notifSuccess);
        console.log(users);
        var title = [];
        var description = [];
        var i = 0;
        var x = 0;
        
        for (var key in users) {
        if (!users.hasOwnProperty(key)) continue;
            var obj = users[key];
            for (var atribut in obj){
                if (!obj.hasOwnProperty(atribut)) continue;
                    if (atribut == "judul"){
                        title[i]=obj.judul;  
                        i++;
                    }
                    if (atribut == "deskripsi"){
                        description[x]=obj.deskripsi;
                        x++;
                    }
            }
    }  
        for(y = 0 ; y<title.length ; y++  ){
            toastr.success(description[y], title[y], {
                timeOut: 50000,
                closeButton: !0})
        }    
    });
</script>

<script>
    $(document).ready(function(){
        var users = @json($notifFail);
        console.log(users);
        var title = [];
        var description = [];
        var i = 0;
        var x = 0;
        
        for (var key in users) {
        if (!users.hasOwnProperty(key)) continue;
            var obj = users[key];
            for (var atribut in obj){
                if (!obj.hasOwnProperty(atribut)) continue;
                    if (atribut == "judul"){
                        title[i]=obj.judul;  
                        i++;
                    }
                    if (atribut == "deskripsi"){
                        description[x]=obj.deskripsi;
                        x++;
                    }
            }
    }  
        for(y = 0 ; y<title.length ; y++  ){
            toastr.error(description[y], title[y], {
                timeOut: 50000,
                closeButton: !0})
        }    
    });
</script>

<script>
    document.getElementById('inputGroupFile01').onchange = function () {
       
        var text = this.value;
        document.getElementById("p1").innerHTML = text;
};
</script>
{{-- <script src="{{asset('assets/js/vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('assets/js/vendor/pickadate/picker.date.js')}}"></script> --}}

<script src="{{asset('assets/js/vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('assets/js/vendor/pickadate/picker.time.js')}}"></script>
<script src="{{asset('assets/js/vendor/pickadate/picker.date.js')}}"></script>

@endsection

@section('bottom-js')
<script src="{{asset('assets/js/form.validation.script.js')}}"></script>
<script src="{{asset('assets/js/form.basic.script.js')}}"></script>
@include('sweetalert::alert')

@endsection