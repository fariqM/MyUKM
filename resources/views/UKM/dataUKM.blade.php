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
                                <th>File</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Pukul</th>
                                <th>Tempat</th>
                                <th>PJ</th>
                                <th>Dibuat tanggal</th>
                            </tr>
                        <tbody>
                            @foreach ($file as $key=>$data)
                            <tr>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn bg-white _r_btn" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <span class="_dot _inline-dot bg-warning"></span>
                                            <span class="_dot _inline-dot bg-warning"></span>
                                            <span class="_dot _inline-dot bg-warning"></span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a type="button" class="dropdown-item btn btn-danger" href="/dokumen/{{ $data->name }}/edit">Edit</a>
                                            <a type="button" class=" dropdown-item btn btn-danger btn-block mb-3"
                                                id="alert-confirm" href="/dokumen/{{ $data->name }}/delete">Hapus</a>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ ++$key }}</td>
                                <td><a href="/dokumen/{{ $data->id }}">{{ $data->name }}</a></td>
                                <td>{{ $data->judul }}</td>
                                <td>{{ $data->tanggal }}</td>
                                <td>{{ str_replace(":00","",$data->mulai). " - " .str_replace(":00","",$data->selesai) }}
                                </td>
                                <td>{{ $data->tempat }}</td>
                                <td>{{ $data->pj }}</td>
                                <td>{{ $data->updated_at->format("d F Y") }}</td>
                            </tr>
                            @endforeach


                            {{-- <div class="card-title">Alert Action</div> --}}




                        </tbody>
                        {{-- <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Tipe</th>
                                <th>Dibuat tanggal</th>
                                <th>Diubah tanggal</th>
                            </tr>
                        </tfoot> --}}
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