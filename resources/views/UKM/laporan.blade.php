@extends('UKM.layouts.master')

@section('page-css')
<link rel="stylesheet" href="{{asset('assets/styles/vendor/dropzone.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.date.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">

@endsection

@section('main-content')
<div class="breadcrumb">
    <h1>Layanan</h1>
    <ul>
        <li>Pelaporan SPJ kegiatan</li>
    </ul>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="container" id="cont">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs justify-content-start mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a onclick="hiya()" class="nav-link active" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab"
                        aria-controls="invoice" aria-selected="false">Data ter-Acc</a>
                </li>
                <li class="nav-item" style="">
                    <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit"
                        aria-selected="true">Upload SPJ</a>
                </li>
            </ul>
            <div class="card">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
                        <table id="check" class="table table-hover mb-3">
                            <thead class="bg-gray-300">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Proposal</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tanggal Kegiatan</th>
                                    <th scope="col">PenanggungJawab</th>
                                    <th scope="col">Tempat</th>
                                    <th scope="col">SPJ</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prop as $key=>$data)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{ $data->judul }}</td>
                                    <td>{{ $data->status }}</td>
                                    <td>{{ $data->tanggal }}</td>
                                    <td>{{ $data->PenanggungJawab }}</td>
                                    <td>{{ $data->tempat }}</td>
                                    @if ($data->proposal_id == null)
                                    <td>SPJ belum diapload</td>
                                    @else
                                    <td><a href="/SPJ/{{ encrypt($data->spj_slug) }}">{{ $data->spj_name }}</a></td>
                                    @endif
                                    @if ($data->spj_name == null)
                                    <td>
                                        <button onclick="checkb(this)" data-tanggal="{{ date_format(date_create($data->tanggal),"d F Y") }}"
                                            data-judul="{{ $data->judul }}" data-pj="{{ $data->PenanggungJawab }}"
                                            data-slug="{{ encrypt($data->id) }}" data-title="{{ $data->id }}"
                                            id="tab2Button" class="btn btn-outline-secondary float-right">Upload
                                            Proposal</button>
                                        
                                    </td>
                                    @else
                                    <td>
                                        <button disabled class="btn btn-success float-right">Berkas
                                            Lenkap</button>
                                    </td>
                                    @endif

                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                        <div class="card-body">
                            <div id="print-area">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="font-weight-bold">Informasi kegiatan</h4>
                                        <p>{{ $uid->name }}</p>
                                        <p><a href="emailto: {{ $uid->email }}">{{ $uid->email }}</a></p>
                                        

                                    </div>
                                    <div class="col-md-6 text-sm-right">

                                        <p> <strong>Proposal terkait:</strong> <a style="color: #463f4d"
                                                id="P-Judul">Nama Proposal</a>
                                        </p>
                                        <p><strong>Tanggal Kegiatan: </strong><a id="P-Tanggal"> 10 Dec, 2018</a></p>
                                        <p><strong>Penanggung Jawab: </strong><a id="P-PJ">NamaPenanggungJawab</a></p>
                                    </div>
                                </div>
                            </div>


                            <form name="myform" action="/SPJ/sesat" method="POST" enctype="multipart/form-data">
                                @csrf
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
                                <button class="btn btn-primary mt-4 btn-lg">Selesai</button>
                            </form>

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>
</div>
</div>

@endsection

@section('page-js')
<script>
    function hiya(){
        document.myform.action = "#";
    }
</script>

<script>
    function checkb(poem){
        document.getElementById("P-Judul").innerHTML = poem.getAttribute("data-judul");
        document.getElementById("P-Tanggal").innerHTML = poem.getAttribute("data-tanggal");
        document.getElementById("P-PJ").innerHTML = poem.getAttribute("data-pj");
        document.myform.action =  "/SPJ/"+poem.getAttribute("data-slug")+"/store";
        $('#myTab li:eq(1) a').tab('show');
    }
</script>
<script>
    document.getElementById('inputGroupFile01').onchange = function () {
       
        var text = this.value;
        document.getElementById("p1").innerHTML = text;
};
</script>

<script src="{{asset('assets/js/vendor/dropzone.min.js')}}"></script>
<script src="{{asset('assets/js/dropzone.script.js')}}"></script>
<script src="{{asset('assets/js/vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('assets/js/vendor/pickadate/picker.date.js')}}"></script>
<script src="{{asset('assets/js/invoice.script.js')}}"></script>
@endsection

@section('bottom-js')
<script src="{{asset('assets/js/form.basic.script.js')}}"></script>
@include('sweetalert::alert')
@endsection