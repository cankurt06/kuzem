@extends('layouts.app')
@section('head')
    <title>{{config('app.name')}} | Bağış</title>
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

                    <div class="entry-footer mt-5">
                        <a href="{{route('bagis_yap',['slug'=>$bagis->slug])}}" class="btn gradient-bg">Bağış Yap</a>
                    </div><!-- .entry-footer -->
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
@endsection
