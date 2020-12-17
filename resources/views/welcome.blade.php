@extends('layouts.app')

@section('content')
    <div class="header py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg col-md">
                        <h1 class="text-white">{{ __('Ahlan Wasahlan!!') }}</h1>
                        <p class="text-lead text-light">
                            {{ __('Selamatkan datang di Prototype aplikasi berbasis web MyUKM.') }}
                        </p>
                        <p class="text-lead text-light">
                            {{ __('Developed by kelompok 5 as DreamyWaze Software') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
