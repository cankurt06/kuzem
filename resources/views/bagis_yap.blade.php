@extends('layouts.app')
@section('head')
    <title>{{config('app.name')}} | Bağış Yap</title>
@stop
@section('bodyclass') single-page single-cause @stop
@section('content')
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>{{$bagis->bagis_slogan}}</h1>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->

    <div class="highlighted-cause">
        <div class="container">
            <div class="row">
                @if (session('basarili'))
                    <div class="alert alert-success" role="alert">
                        Bağış yaptığınız için öncelikle teşekkürler :)<br> XXXX Bankası XXX Şubesi TR330006100519786457841326 Iban numaralı hesaba {{session('basarili')["tutar"]}} TL tutarında havalenizi yaptıktan sonra bağışınız onaylanacaktır.<br>
                        Lütfen havale açıklamasına sadece bağış numaranızı <b>{{session('basarili')["bagisno"]}}</b> yazınız.
                    </div>
                @endif
                @if (session('hata'))
                    <div class="alert alert-danger" role="alert">
                        {{session('hata')}}
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-12 col-lg-7 order-2 order-lg-1">
                    <div class="section-heading">
                        <h2 class="entry-title">{{$bagis->bagis_adi}}</h2>
                    </div><!-- .section-heading -->

                    <div class="entry-content mt-5">
                        <p>{{$bagis->bagis_slogan}}</p>
                    </div><!-- .entry-content -->

                    <div class="fund-raised w-100 mt-5">
                        <div class="featured-fund-raised-bar barfiller">
                            <div class="tipWrap">
                                <span class="tip"></span>
                            </div><!-- .tipWrap -->

                            <span class="fill" data-percentage="{{anasayfa::bagis_tamamlama_orani($bagis->bagis_tutar,anasayfa::yapilan_bagis_toplami($bagis->id))}}"></span>
                        </div><!-- .fund-raised-bar -->

                        <div class="fund-raised-details d-flex flex-wrap justify-content-between align-items-center">
                            <div class="fund-raised-total mt-4">
                                Tamamlanan Tutar: {{anasayfa::turk_parasi_yap(anasayfa::yapilan_bagis_toplami($bagis->id))}}
                            </div><!-- .fund-raised-total -->

                            <div class="fund-raised-goal mt-4">
                                Hedef Tutar: {{anasayfa::turk_parasi_yap($bagis->bagis_tutar)}}
                            </div><!-- .fund-raised-goal -->
                        </div><!-- .fund-raised-details -->
                    </div><!-- .fund-raised -->
                </div><!-- .col -->

                <div class="col-12 col-lg-5 order-1 order-lg-2">
                    <img src="{{asset($bagis->bagis_resmi)}}" alt="">
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .highlighted-cause -->

    <div class="short-content-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="short-content">
                        <h3 class="entry-title">Bilgi</h3>
                    {!! $bagis->bagis_icerik !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="donation-form-wrap">
                    <h2>Bağış Yapın</h2>

                    <h4 class="mt-5">Ne kadar bağış yapmayı düşünüyorsunuz ?</h4>

                    <form class="donation-form" autocomplete="off" method="POST" action="{{route('bagis_yap_post')}}">
                        @csrf
                        <input type="hidden" name="bagis_id" value="{{$bagis->id}}">
                        <div class="donate-amount-wrap d-flex flex-wrap align-items-center mt-5">
                            <label class="radio-label">
                                <input type="radio" name="tutar" value="5" />
                                <span class="donate-amount">5 TL</span>
                            </label>

                            <label class="radio-label">
                                <input type="radio" name="tutar" value="10" />
                                <span class="donate-amount">10 TL</span>
                            </label>

                            <label class="radio-label">
                                <input type="radio" name="tutar" value="25" checked="checked"/>
                                <span class="donate-amount">25 TL</span>
                            </label>

                            <label class="radio-label">
                                <input type="radio" name="tutar" value="50" />
                                <span class="donate-amount">50 TL</span>
                            </label>

                            <label class="radio-label">
                                <input type="radio" name="tutar" value="100" />
                                <span class="donate-amount">100 TL</span>
                            </label>

                            <label class="radio-label">
                                <input type="radio" name="tutar" value="custom" />
                                <span class="donate-amount">Elle Tutar Gir</span>
                            </label>
                            <label class="radio-label">
                                <input class="donate-amount" type="text" name="elle_tutar" style="display: none;font-size: 60px"/>
                            </label>
                        </div>

                        <input class="btn gradient-bg mt-5" type="submit" value="Bağış Yap">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
