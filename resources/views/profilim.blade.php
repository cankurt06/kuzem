@extends('layouts.app')
@section('head')
    <title>{{config('app.name')}} | Profilim</title>
@stop
@section('bodyclass') single-page causes-page @stop
@section('content')
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Profilim</h1>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->

    <div class="contact-page-wrap">
        <div class="container">
            <div class="row" style="padding-top: 25px">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('profil_guncelle') }}" aria-label="{{ __('Güncelle') }}" autocomplete="off">
                                @csrf
                                <div class="form-group row">
                                    <label for="tc_kimlik" class="col-md-4 col-form-label text-md-right">{{ __('TC Kimlik') }}</label>

                                    <div class="col-md-6">
                                        <input id="tc_kimlik" type="text" class="form-control{{ $errors->has('tc_kimlik') ? ' is-invalid' : '' }}" name="tc_kimlik" value="{{ $kullanici_bilgileri->tc_kimlik }}" required autofocus>

                                        @if ($errors->has('tc_kimlik'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tc_kimlik') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Adı Soyadı') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $kullanici_bilgileri->name}}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="telefon" class="col-md-4 col-form-label text-md-right">{{ __('Cep Telefon Numarası') }}</label>

                                    <div class="col-md-6">
                                        <input id="telefon" type="text" class="form-control{{ $errors->has('telefon') ? ' is-invalid' : '' }}" name="telefon" value="{{ $kullanici_bilgileri->telefon }}" required autofocus>

                                        @if ($errors->has('telefon'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('telefon') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Eposta Adresi') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $kullanici_bilgileri->email }}" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Şifre') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Şifre Tekrar') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn gradient-bg mr-2">
                                            {{ __('Güncelle') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- .row -->
        </div><!-- .container -->
    </div>

@endsection
@section('script')
    <script src="{{asset('admin/js/sweetalert2.js')}}"></script>
    @if(session('sonuc'))
        <script>
            Swal.fire({
                type: '{{session('sonuc')[0]}}',
                title: '{{session('sonuc')[1]}}',
                confirmButtonText: 'Tamam'
            })
        </script>
    @endif
@endsection