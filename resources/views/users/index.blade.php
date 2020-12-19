@extends('layouts.app', ['page' => __('User Management'), 'pageSlug' => 'users'])

@section('content')
<div class="content">

    @if (session()->has('addUKM'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Akun UKM</strong> telah berhasil dibuat. Pastikan yang bersangkutan membaca User-Guide. Terima kasih.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="tim-icons icon-simple-remove"></i>
        </button>
    </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card ">

                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="title" style="text-shadow: 0px 1px 1px #00E9C7"><b>{{ __('Edit User') }}</b></h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('AddUserForm') }}" class="btn btn-sm btn-primary">Add user</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">


                    <table class="table" id="">
                        <thead class=" text-primary">
                            <tr>
                                <th scope="col" style="font-size: 14px">Nama</th>
                                <th scope="col" style="font-size: 14px">Email</th>
                                <th scope="col" style="font-size: 14px">Jabatan</th>
                                <th scope="col" style="font-size: 14px">Tanggal dibuat</th>
                                <th scope="col" style="font-size: 14px">Terakhir diedit</th>
                                <th scope="col" style="font-size: 14px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>
                                    <a href="{{ $user->email }}">{{ $user->email }}</a>
                                </td>
                                <td>{{ str_replace('[]',"Role belum diatur", str_replace('["',"", str_replace('"]',"", $user->getRoleNames())))  }}</td>
                                <td>{{ $user->created_at->format("d-M-Y") }}</td>
                                <td>{{ $user->updated_at->format("d-M-Y") }}</td>
                                <td class="text-right">
                                    <div class="dropdown">

                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>


                                        @can('edit user')
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <div>

                                                <a class="dropdown-item"
                                                    href="/user/{{ $user->name }}">{{__('Edit')}}</a>

                                                @can('delete user')

                                                <a class="dropdown-item"
                                                    href="/user/destroy/{{ $user->id }}">{{__('Hapus')}}</a>
                                                @endcan

                                            </div>
                                        </div>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    @for ($i = 1; $i <= $halaman; $i++)
                     
                    
                    <li class="page-item"><a class="page-link" href="user?page={{ $i }}">{{ $i }}</a></li>
                    @endfor
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>

                </ul>
              </nav>

        </div>
    </div>
</div>
@endsection

@section('bottom-js')
@include('sweetalert::alert')

@endsection