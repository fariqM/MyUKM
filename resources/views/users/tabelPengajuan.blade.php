@extends('layouts.app', ['page' => __('Tabel'), 'pageSlug' => 'TabelPengajuan'])


@section('admin-css')
<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
@endsection

@section('content')

@if (session()->has('tolakProp'))
{{ alertsuccess('System', 'berhasil ditolak') }}
@endif

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
                                    {{ Str::limit($user->judul, 13) }}
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
                                <td> {{ date_format(date_create($user->tanggal),"d F Y") }}</td>

                                <td>{{ substr_replace($user->mulai,"",5)." - ". substr_replace($user->selesai,"",5)." WIB"}}
                                </td>
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

                                            <button type="button" class="btn-primary animation-on-hover dropdown-item"
                                                data-toggle="modal" data-target="#verifyModalContent"
                                                data-whatever="@ADMIN" data-prop="{{ $user->id }}">Tolak
                                            </button>
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
                                                    href="/adminTable/Pengajuan/{{ $user->slug }}/edit">{{__('Edit')}}</a>
                                                <a class="dropdown-item"
                                                    href="/adminTable/Pengajuan/{{ $user->slug }}/delete">{{__('Hapus')}}</a>

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

{{-- MODAL KONFIRMASI DELETE --}}
<div class="modal fade" id="verifyModalContent" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div style="background-color:#28334F" class="modal-content">
            <div class="modal-header">
                <h4 style="color: lightgray" class="modal-title" id="verifyModalContent_title">Kirim pesan kepada <a
                        href="/user/{{ ukmName($user->user_id) }}">{{ PropToUKM($user->id) }}</a>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- <form action="/adminTable/Pengajuan/{{ $user->id }}/tolak" method="POST">
                @csrf --}}
                <div class="form-group">
                    <label style="color: lightgray" for="recipient-name-2" class="col-form-label">Oleh:</label>
                    <input id="TextPengirim" name="pengirim" disabled style="border-color:#8C8CDA; color: #00EFC4"
                        type="text" class="form-control" id="recipient-name-2">
                </div>
                <div class="form-group">
                    <label style="color: lightgray" for="message-text-1" class="col-form-label">Alasan
                        ditolak:</label>
                    <textarea name="deskripsi" style="border-color:#8C8CDA" class="form-control"
                        id="message-text-1"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="TButton" class="btn btn-primary">Send message</button>
                </div>
                {{-- </form> --}}
            </div>

        </div>
    </div>
</div>
@endsection

@section('page-js')
<script>
    $(document).ready(function(){
        $('#verifyModalContent').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) 
        var recipient = button.data('whatever') 
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
            $('#TButton').click(function(){
                var pengirim = document.getElementById("TextPengirim").value;
                var deskripsi = document.getElementById("message-text-1").value;
                var userid = button.data('prop');
                $.ajaxSetup({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({         
                        url:"/adminTable/Pengajuan/"+userid+"/tolak", 
                        type: "POST",
                        data: 'pengirim=' + pengirim + '&deskripsi=' + deskripsi, 
                        success: function(){
                            location.reload();
                        },
                        error: function(){
                        $('.toast').toast('ERROR');
                        }
                    });
            });
        }); 
    });
</script>
<script src="{{asset('assets/js/es5/task-manager-list.min.js')}}"></script>
@endsection


@section('bottom-js')
<script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
<script src="{{asset('assets/js/datatables.script.js')}}"></script>
@include('sweetalert::alert')

@endsection