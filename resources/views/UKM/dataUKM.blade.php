@extends('UKM.layouts.master')


@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">

@endsection

@section('main-content')

@if (session()->has('updateProp'))
{{ successToast('Proposal berhasil diedit, tunggu sampai konfirmasi berikutnya. anda akan dapat notifikasi ketika proposal ditolak/di-acc') }}
@endif


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
                    <table id="scroll_horizontal_table"
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
                            <p hidden>{{ $nomer = 0  }}</p>
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
                                            <a type="button" class="dropdown-item btn btn-warning"
                                                href="/dokumen/{{ encrypt($data->slug) }}/edit">Edit</a>
                                            @if ($data->status == "Ditolak")
                                            <button type="button" class=" dropdown-item btn btn-danger btn-block mb-3"
                                                id="alert-confirm" data-toggle="modal"
                                                data-target="#exampleModal">Hapus</button>
                                            @else
                                            @if ($data->status == null)
                                            <button type="button" class=" dropdown-item btn btn-danger btn-block mb-3"
                                                id="alert-confirm" data-toggle="modal"
                                                data-target="#exampleModal">Hapus</button>
                                            @endif
                                            @endif


                                        </div>
                                    </div>
                                </td>
                                @if ($data->status === null || $data->status == null)
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

                                <td><a href="/dokumen/{{ encrypt($data->slug) }}">{{ $data->name }}</a></td>
                                <td>{{ $data->judul }}</td>
                                <td>{{ date_format(date_create($data->tanggal),"d F Y") }}</td>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b>Hapus berkas proposal ?</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Berkas proposal {{ $data->judul }} akan dihapus, jika anda ragu menghapusnya anda bisa meninjau kembali berkas proposal dengan klik <a href="/dokumen/{{ encrypt($data->slug) }}/edit" class="badge badge-primary m-2">DISINI </a></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a href="/dokumen/{{ encrypt($data->slug) }}/delete" type="button" class="btn btn-primary">Hapus</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-js')
<script src="{{asset('assets/js/modal.script.js')}}"></script>
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
        $('#alert-confirm').click(function () {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0CC27E',
                cancelButtonColor: '#FF586B',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success mr-5',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function () {
                swal(
                    'Deleted!',
                    'Your imaginary file has been deleted.',
                    'success'
                )
            }, function (dismiss) {
                // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                if (dismiss === 'cancel') {
                    swal(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            });
        });
    });
</script>
<script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
<script src="{{asset('assets/js/datatables.script.js')}}"></script>

@include('sweetalert::alert')
@endsection