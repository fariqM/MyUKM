@extends('layouts.app', ['page' => __('Tabel'), 'pageSlug' => 'TabelPengajuan'])


@section('admin-css')
<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
@endsection

@section('content')
<div class="content">

    <div class="card">
        <div class="col-md-12 mb-4">
            <div class="card-body w-100 ml-auto mr-auto">
                <div class="table-responsive">
                    <table id="zero_configuration_table" class="display table table-striped  " style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>File</th>
                                <th>Tanggal</th>
                                <th>Pukul</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key=>$user)
                            <tr>
                                <td>{{ ++$key}}</td>
                                <td>
                                   {{ $user->judul }}
                                </td>
                                @if ($user->status == null)
                                <td style="background-color: rgb(255, 255, 0)">
                                    <b style="color: black">Pending</b>
                                </td>
                                @else
                                @if ($user->status == 'ACC')
                                <td style="background-color: #00D0D4">
                                    <b style="color: black">{{ $user->status }}</b>
                                </td>
                                @else
                                <td style="background-color: red">
                                    <b style="color: black">{{ $user->status }}</b>
                                </td>
                                @endif


                                @endif

                                <td> <a href="/Doc/{{ $user->id }}">{{ $user->name }}</a></td>
                                <td> {{ $user->tanggal }}</td>

                                <td>{{ str_replace(":00","",$user->mulai). " - " .str_replace(":00","",$user->selesai) }}
                                </td>
                                <td>
                                    <div class="btn-group dropup">
                                        <button class="btn btn-info custom-btn  btn-sm dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Acc/Tolak
                                        </button>
                                        <div class="dropdown-menu dropdown-black">

                                            <form action="/adminTable/Pengajuan/{{ $user->id }}/acc" method="POST">
                                                @csrf
                                                <button class="btn-success animation-on-hover dropdown-item"
                                                    type="submit"><span
                                                        class="ul-task-manager__dot bg-succes mr-2"></span><b>ACC</b></button>
                                            </form>
                                            <form action="/adminTable/Pengajuan/{{ $user->id }}/tolak" method="POST">
                                                @csrf
                                                <button class="btn-danger animation-on-hover dropdown-item"
                                                    type="submit"><span
                                                        class="ul-task-manager__dot bg-danger mr-2"></span><b>Tolak</b></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-right">
                                    <div class="btn-group dropup">

                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <div>
                                                <a class="dropdown-item"
                                                    href="/adminTable/Pengajuan/{{ $user->name }}/edit">{{__('Edit')}}</a>
                                                <a class="dropdown-item"
                                                    href="/adminTable/Pengajuan/{{ $user->name }}/delete">{{__('Hapus')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('page-js')
<script src="{{asset('assets/js/es5/task-manager-list.min.js')}}"></script>
@endsection


@section('bottom-js')
<script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
<script src="{{asset('assets/js/datatables.script.js')}}"></script>
@include('sweetalert::alert')

@endsection