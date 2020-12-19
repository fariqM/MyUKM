@extends('UKM.layouts.master')


@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/sweetalert2.min.css')}}">
@endsection

@section('main-content')
<div class="breadrumb">
    <div class="breadcrumb">
        <h1>NAMA UKM</h1>
        <ul>
            <li><a href="#">Data</a></li>
            <li>SPJ</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>

    <div class="col-md-12 mb-4">
        <div class="card  text-left">
            <div class="card-body">
                <h4 class="card-title mb-3">Peringatan</h4>


                <p>laporan Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    ga velit culpa nam cupiditate similique sit, pariatur sed est mollipsum dolor sit amet consectetur
                    adipisicing elit.
                    ga velit culpa nam cupiditate similique sit, pariatur sed est molli</p>
            </div>
            <div class="card-body w-100 ml-auto mr-auto">


                <div class="table-responsive">
                    <table id="scroll_horizontal_vertical_table"
                        class="display nowrap table table-striped table-bordered" style="width:120%">
                        <thead>
                            <tr>
                                <th>Aksi</th>
                                <th>No</th>
                                <th>Status</th>
                                <th>File</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Pukul</th>
                                <th>Tempat</th>
                                <th>PJ</th>
                                <th>Dibuat tanggal</th>
                            </tr>
                        <tbody>
                            {{ $nomer = 0 }}
                            @foreach ($file as $key=> $data)

                            <tr>
                                <td>{{ ++$nomer }}</td>
                                <td>

                                    <div class="btn-group">
                                        <button type="button" class="btn bg-white _r_btn" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <span class="_dot _inline-dot bg-warning"></span>
                                            <span class="_dot _inline-dot bg-warning"></span>
                                            <span class="_dot _inline-dot bg-warning"></span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a type="button" class="dropdown-item btn btn-danger"
                                                href="/dokumen/{{ $data->name }}/edit">Edit</a>
                                            @if ($data->status == "Ditolak")
                                            <a type="button" class=" dropdown-item btn btn-danger btn-block mb-3"
                                                id="alert-confirm" href="/dokumen/{{ $data->name }}/delete">Hapus</a>
                                            @else
                                            @if ($data->status === null)
                                            <a type="button" class=" dropdown-item btn btn-danger btn-block mb-3"
                                                id="alert-confirm" href="/dokumen/{{ $data->name }}/delete">Hapus</a>
                                            @endif
                                            @endif


                                        </div>
                                    </div>
                                </td>
                                @if ($data->status === null)
                                <td><a href="#" style="font-size: 15px" class="badge badge-light m-2">Pending</a></td>
                                @else
                                @if ($data->status == "ACC" )

                                <td><a href="#" style="font-size: 15px"
                                        class="badge badge-success m-2">{{ $data->status }}</a></td>
                                @else
                                <td><a href="#" style="font-size: 15px"
                                        class="badge badge-danger m-2">{{ $data->status }}</a></td>
                                @endif

                                @endif

                                <td><a href="/dokumen/{{ $data->id }}">{{ $data->name }}</a></td>
                                <td>{{ $data->judul }}</td>
                                <td>{{ $data->tanggal }}</td>
                                <td>{{ str_replace(":00","",$data->mulai). " - " .str_replace(":00","",$data->selesai) }}
                                </td>
                                <td>{{ $data->tempat }}</td>
                                <td>{{ $data->PenanggungJawab }}</td>
                                <td>{{ $data->updated_at->format("d F Y") }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </thead>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('page-js')
<script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/js/sweetalert.script.js')}}"></script>
<script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
<script src="{{asset('assets/js/datatables.script.js')}}"></script>
@include('sweetalert::alert')
@endsection