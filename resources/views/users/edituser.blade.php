@extends('layouts.app', ['page' => __('users'), 'pageSlug' => 'users'])


@section('content')


<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="title" style="text-shadow: 0px 1px 1px #00E9C7"><b>{{ __('Edit User') }}</b></h4>
            </div>
            <form method="post" action="/user/{{ $user->name }}/update" autocomplete="off">
                <div class="card-body">
                    @csrf
                    @method('put')

                    @include('alerts.success')

                    <div class="form-group">
                        <label>{{ __('Name') }}</label>
                        <input type="text" name="name"
                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Name') }}" value="{{ old('tempat') ?? $user->name }}">
                            
                    </div>

                    <div class="form-group">
                        <label>{{ __('Email address') }}</label>
                        <input type="email" name="email"
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Email address') }}" value="{{ old('tempat') ?? $user->email }}">
                        
                    </div>

                    <div class="form-group ">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" name="role[]">

                            @foreach ($user->roles as $jabatanSekarang)
                            <option  selected value="{{ $jabatanSekarang -> id }}">{{ $jabatanSekarang -> name }}</option>
                            @endforeach

                            @foreach ($role as $jabatan)
                            <option   value="{{ $jabatan -> id }}">{{ $jabatan -> name }}</option>
                            @endforeach

                        </select>
                    </div>

                </div>
                <div class="card-footer d-flex justify-content-between">
                    <button type="submit" aria-disabled={{ auth()->check() ? "false" : "true" }}
                        class="btn btn-fill btn-success  animation-on-hover">{{ __('Simpan') }}</button>

                    <a href="../user" class="btn  btn-fill btn-info  animation-on-hover" role="button">Kembali</a>
                </div>
            </form>
        </div>

</div>
@endsection