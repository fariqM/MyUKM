<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"">
<head>
    <meta charset=" UTF-8">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Black Dashboard') }}</title>
<!-- Favicon -->
<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('black') }}/img/apple-icon.png">
<link rel="icon" type="image/png" href="{{ asset('black') }}/img/favicon.png">
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<!-- Icons -->
<link href="{{ asset('black') }}/css/nucleo-icons.css" rel="stylesheet" />
<!-- CSS -->
<link href="{{ asset('black') }}/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
<link href="{{ asset('black') }}/css/theme.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    @include('layouts.navbars.navs.guest')
    @auth()
    <div class="wrapper wrapper-full-page">
        <div class="full-page register-page">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 mr-auto">
                            <div class="card card-register card-white">
                                <div class="card-header">
                                    <img class="card-img" src="{{ asset('black') }}/img/card-primary.png"
                                        alt="Card image">
                                    <h4 class="card-title" style="color: #1E1E2F">{{ __('Buat Akun') }}</h4>
                                </div>
                                <form class="form" method="post" action="{{ route('AddUser') }}">
                                    @csrf

                                    <div class="card-body">


                                        <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tim-icons icon-single-02"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="name" id="name"
                                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Name') }}" value="{{ old('name') }}">
                                                
                                            @include('alerts.feedback', ['field' => 'name'])
                                        </div>


                                        <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tim-icons icon-email-85"></i>
                                                </div>
                                            </div>
                                            <input type="email" name="email" id="email"
                                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Email') }}" value="{{ old('email') }}">
                                            @include('alerts.feedback', ['field' => 'email'])
                                        </div>


                                        <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tim-icons icon-lock-circle"></i>
                                                </div>
                                            </div>
                                            <input type="password" name="password"
                                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Password') }}">
                                            @include('alerts.feedback', ['field' => 'password'])
                                        </div>


                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tim-icons icon-lock-circle"></i>
                                                </div>
                                            </div>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="{{ __('Confirm Password') }}">
                                        </div>

                                        <div class="form-check text-left">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox">
                                                <span class="form-check-sign"></span>
                                                {{ __('Persyaratan SOP') }}
                                                <a href="#">{{ __('Pembuatan Akun UKM') }}</a>
                                                {{ __('telah dipenuhi.') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit"
                                            class="btn btn-primary btn-round btn-lg">{{ __('Buat Akun') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-5 ml-auto">
                            <div class="info-area info-horizontal mt-5">
                                <div class="icon icon-warning">
                                    <i class="tim-icons icon-badge"></i>
                                </div>
                                <div class="description">
                                    <h3 class="info-title">{{ __('Cek Kredensial UKM') }}</h3>
                                    <p class="description">
                                        {{ __('BlaBlaBLA BlaBlaBLABlaBlaBLABlaBlaBLABlaBlaBLA BlaBlaBLA BlaBlaBLA') }}
                                    </p>
                                </div>
                            </div>
                            <div class="info-area info-horizontal">
                                <div class="icon icon-primary">
                                    <i class="tim-icons icon-square-pin"></i>
                                </div>
                                <div class="description">
                                    <h3 class="info-title">{{ __('Cek Bukti Fisik UKM') }}</h3>
                                    <p class="description">
                                        {{ __('BlaBlaBLA BlaBlaBLABlaBlaBLABlaBlaBLABlaBlaBLA BlaBlaBLA BlaBlaBLA') }}
                                    </p>
                                </div>
                            </div>
                            <div class="info-area info-horizontal">
                                <div class="icon icon-info">
                                    <i class="tim-icons icon-check-2"></i>
                                </div>
                                <div class="description">
                                    <h3 class="info-title">{{ __('Serah Terima Bukti Pembuatan Akun UKM') }}</h3>
                                    <p class="description">
                                        {{ __('BlaBlaBLA BlaBlaBLABlaBlaBLABlaBlaBLABlaBlaBLA BlaBlaBLA BlaBlaBLA') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
    @endauth
</body>

</html>