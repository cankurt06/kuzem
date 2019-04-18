@extends('layouts.app')
@section('head')
    <title>{{config('app.name')}} | Bağışlar</title>
@stop
@section('bodyclass') single-page causes-page @stop
@section('content')
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Bağışlar</h1>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->

    <div class="featured-cause">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h2 class="entry-title">Devam Eden Bağışlar</h2>
                    </div><!-- .section-heading -->
                </div><!-- .col -->
            </div><!-- .row -->

            <div class="row">
                    @foreach($aktif_bagislar as $aktif_bagis)
                <div class="col-12 col-lg-6">
                    <div class="cause-wrap d-flex flex-wrap justify-content-between" style="height: 500px;max-height: 500px;">
                        <figure class="m-0">
                            <img src="{{asset($aktif_bagis->bagis_resmi)}}" alt="" style="width: 250px;height: 300px">
                        </figure>

                        <div class="cause-content-wrap">
                            <header class="entry-header d-flex flex-wrap align-items-center">
                                <h3 class="entry-title w-100 m-0"><a href="{{route('bagislar',["slug"=>$aktif_bagis->slug])}}">{{$aktif_bagis->bagis_adi}}</a></h3>

                                <div class="posted-date">
                                    <a href="#">{{carbon::parse($aktif_bagis->created_at)->format('d.m.Y')}} </a>
                                </div><!-- .posted-date -->

                                <div class="cats-links">
                                    <a href="#">{{$aktif_bagis->get_kategori->bagis_turu}}</a>
                                </div><!-- .cats-links -->
                            </header><!-- .entry-header -->

                            <div class="entry-content">
                                <p class="m-0">{{$aktif_bagis->bagis_slogan}}</p>
                            </div><!-- .entry-content -->

                            <div class="entry-footer mt-5">
                                <a href="{{route('bagis_yap',["slug"=>$aktif_bagis->slug])}}" class="btn gradient-bg mr-2">Bağış Yap</a>
                            </div><!-- .entry-footer -->
                        </div><!-- .cause-content-wrap -->

                        <div class="fund-raised w-100">
                            <div class="featured-fund-raised-bar-{{$aktif_bagis->id}} barfiller">
                                <div class="tipWrap">
                                    <span class="tip"></span>
                                </div><!-- .tipWrap -->

                                <span class="fill" data-percentage="{{anasayfa::bagis_tamamlama_orani($aktif_bagis->bagis_tutar,anasayfa::yapilan_bagis_toplami($aktif_bagis->id))}}"></span>
                            </div><!-- .fund-raised-bar -->

                            <div class="fund-raised-details d-flex flex-wrap justify-content-between align-items-center">
                                <div class="fund-raised-total mt-4">
                                    Tamamlanan Tutar: {{anasayfa::turk_parasi_yap(anasayfa::yapilan_bagis_toplami($aktif_bagis->id))}}
                                </div><!-- .fund-raised-total -->

                                <div class="fund-raised-goal mt-4">
                                    Hedef Tutar: {{anasayfa::turk_parasi_yap($aktif_bagis->bagis_tutar)}}
                                </div><!-- .fund-raised-goal -->
                            </div><!-- .fund-raised-details -->
                        </div><!-- .fund-raised -->
                    </div><!-- .cause-wrap -->
                </div><!-- .col -->
                    @endforeach

            </div><!-- .row -->
            <div>   {{ $aktif_bagislar->links('vendor.pagination.bootstrap-4') }}</div>
        </div><!-- .container -->
    </div><!-- .featured-cause -->

    <div class="featured-cause">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h2 class="entry-title">Başlayacak Bağışlar</h2>
                    </div><!-- .section-heading -->
                </div><!-- .col -->
            </div><!-- .row -->

            <div class="row">
                @foreach($yaklasan_bagislar as $yaklasan_bagis)
                    <div class="col-12 col-lg-6">
                        <div class="cause-wrap d-flex flex-wrap justify-content-between" style="height: 500px;max-height: 500px;">
                            <figure class="m-0">
                                <img src="{{asset($yaklasan_bagis->bagis_resmi)}}" alt="" style="width: 250px;height: 300px">
                            </figure>

                            <div class="cause-content-wrap">
                                <header class="entry-header d-flex flex-wrap align-items-center">
                                    <h3 class="entry-title w-100 m-0"><a href="{{route('bagislar',["slug"=>$yaklasan_bagis->slug])}}">{{$yaklasan_bagis->bagis_adi}}</a></h3>

                                    <div class="posted-date">
                                        <a href="#">{{carbon::parse($yaklasan_bagis->created_at)->format('d.m.Y')}} </a>
                                    </div><!-- .posted-date -->

                                    <div class="cats-links">
                                        <a href="#">{{$yaklasan_bagis->get_kategori->bagis_turu}}</a>
                                    </div><!-- .cats-links -->
                                </header><!-- .entry-header -->

                                <div class="entry-content">
                                    <p class="m-0">{{$yaklasan_bagis->bagis_slogan}}</p>
                                </div><!-- .entry-content -->

                                <div class="entry-footer mt-5">

                                </div><!-- .entry-footer -->
                            </div><!-- .cause-content-wrap -->

                            <div class="fund-raised w-100">
                                <div class="featured-fund-raised-bar-{{$yaklasan_bagis->id}} barfiller">
                                    <div class="tipWrap">
                                        <span class="tip"></span>
                                    </div><!-- .tipWrap -->

                                    <span class="fill" data-percentage="{{anasayfa::bagis_tamamlama_orani($yaklasan_bagis->bagis_tutar,anasayfa::yapilan_bagis_toplami($yaklasan_bagis->id))}}"></span>
                                </div><!-- .fund-raised-bar -->

                                <div class="fund-raised-details d-flex flex-wrap justify-content-between align-items-center">
                                    <div class="fund-raised-total mt-4">
                                        Tamamlanan Tutar: {{anasayfa::turk_parasi_yap(anasayfa::yapilan_bagis_toplami($yaklasan_bagis->id))}}
                                    </div><!-- .fund-raised-total -->

                                    <div class="fund-raised-goal mt-4">
                                        Hedef Tutar: {{anasayfa::turk_parasi_yap($yaklasan_bagis->bagis_tutar)}}
                                    </div><!-- .fund-raised-goal -->
                                </div><!-- .fund-raised-details -->
                            </div><!-- .fund-raised -->
                        </div><!-- .cause-wrap -->
                    </div><!-- .col -->
                @endforeach

            </div><!-- .row -->
            <div>
                {{ $yaklasan_bagislar->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div><!-- .container -->
    </div><!-- .featured-cause -->

    <div class="featured-cause">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h2 class="entry-title">Tamamlanan Bağışlar</h2>
                    </div><!-- .section-heading -->
                </div><!-- .col -->
            </div><!-- .row -->

            <div class="row">
                @foreach($tamamlanan_bagislar as $tamamlanan_bagis)
                    <div class="col-12 col-lg-6">
                        <div class="cause-wrap d-flex flex-wrap justify-content-between" style="height: 500px;max-height: 500px;">
                            <figure class="m-0">
                                <img src="{{asset($tamamlanan_bagis->bagis_resmi)}}" alt="" style="width: 250px;height: 300px">
                            </figure>

                            <div class="cause-content-wrap">
                                <header class="entry-header d-flex flex-wrap align-items-center">
                                    <h3 class="entry-title w-100 m-0"><a href="{{route('bagislar',["slug"=>$tamamlanan_bagis->slug])}}">{{$tamamlanan_bagis->bagis_adi}}</a></h3>

                                    <div class="posted-date">
                                        <a href="#">{{carbon::parse($tamamlanan_bagis->created_at)->format('d.m.Y')}} </a>
                                    </div><!-- .posted-date -->

                                    <div class="cats-links">
                                        <a href="#">{{$tamamlanan_bagis->get_kategori->bagis_turu}}</a>
                                    </div><!-- .cats-links -->
                                </header><!-- .entry-header -->

                                <div class="entry-content">
                                    <p class="m-0">{{$tamamlanan_bagis->bagis_slogan}}</p>
                                </div><!-- .entry-content -->

                                <div class="entry-footer mt-5">

                                </div><!-- .entry-footer -->
                            </div><!-- .cause-content-wrap -->

                            <div class="fund-raised w-100">
                                <div class="featured-fund-raised-bar-{{$tamamlanan_bagis->id}} barfiller">
                                    <div class="tipWrap">
                                        <span class="tip"></span>
                                    </div><!-- .tipWrap -->

                                    <span class="fill" data-percentage="{{anasayfa::bagis_tamamlama_orani($tamamlanan_bagis->bagis_tutar,anasayfa::yapilan_bagis_toplami($tamamlanan_bagis->id))}}"></span>
                                </div><!-- .fund-raised-bar -->

                                <div class="fund-raised-details d-flex flex-wrap justify-content-between align-items-center">
                                    <div class="fund-raised-total mt-4">
                                        Tamamlanan Tutar: {{anasayfa::turk_parasi_yap(anasayfa::yapilan_bagis_toplami($tamamlanan_bagis->id))}}
                                    </div><!-- .fund-raised-total -->

                                    <div class="fund-raised-goal mt-4">
                                        Hedef Tutar: {{anasayfa::turk_parasi_yap($tamamlanan_bagis->bagis_tutar)}}
                                    </div><!-- .fund-raised-goal -->
                                </div><!-- .fund-raised-details -->
                            </div><!-- .fund-raised -->
                        </div><!-- .cause-wrap -->
                    </div><!-- .col -->
                @endforeach

            </div><!-- .row -->
            <div>    {{ $tamamlanan_bagislar->links('vendor.pagination.bootstrap-4') }}</div>
        </div><!-- .container -->
    </div><!-- .featured-cause -->
@endsection
@section('script')
    @foreach(\App\Bagislar::get() as $bagis)
        <script>jQuery(document).ready(function ($){bar_filler($,{{$bagis->id}})});</script>
    @endforeach
@endsection