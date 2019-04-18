@extends('layouts.app')
@section('head')
    <title>{{config('app.name')}} | Anasayfa</title>
@stop
@section('content')
    <div class="swiper-container hero-slider">
        <div class="swiper-wrapper">
            @foreach(anasayfa::slaytlar() as $slayt)
                <div class="swiper-slide hero-content-wrap">
                    <img src="{{$slayt->slayt_resmi}}" alt="">

                    <div class="hero-content-overlay position-absolute w-100 h-100">
                        <div class="container h-100">
                            <div class="row h-100">
                                <div class="col-12 col-lg-8 d-flex flex-column justify-content-center align-items-start">
                                    <header class="entry-header">
                                        <h1>{{$slayt->bagis_slogan}}</h1>
                                    </header><!-- .entry-header -->

                                    <div class="entry-content mt-4">
                                        <p>{{$slayt->bagis_adi}}</p>
                                    </div><!-- .entry-content -->

                                    <footer class="entry-footer d-flex flex-wrap align-items-center mt-5">
                                        <a href="{{route('bagis_yap',['slug'=>$slayt->slug])}}" class="btn gradient-bg mr-2">Bağış Yap</a>
                                        <a href="{{route('bagislar',['slug'=>$slayt->slug])}}" class="btn orange-border">Detaylı Bilgi</a>
                                    </footer><!-- .entry-footer -->
                                </div><!-- .col -->
                            </div><!-- .row -->
                        </div><!-- .container -->
                    </div><!-- .hero-content-overlay -->
                </div><!-- .hero-content-wrap -->
            @endforeach
        </div><!-- .swiper-wrapper -->

        <div class="pagination-wrap position-absolute w-100">
            <div class="container">
                <div class="swiper-pagination"></div>
            </div><!-- .container -->
        </div><!-- .pagination-wrap -->

        <!-- Add Arrows -->
        <div class="swiper-button-next flex justify-content-center align-items-center">
            <span><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1171 960q0 13-10 23l-466 466q-10 10-23 10t-23-10l-50-50q-10-10-10-23t10-23l393-393-393-393q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l466 466q10 10 10 23z"/></svg></span>
        </div>

        <div class="swiper-button-prev flex justify-content-center align-items-center">
            <span><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1203 544q0 13-10 23l-393 393 393 393q10 10 10 23t-10 23l-50 50q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l466-466q10-10 23-10t23 10l50 50q10 10 10 23z"/></svg></span>
        </div>
    </div><!-- .hero-slider -->

    <div class="home-page-icon-boxes">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <div class="icon-box active">
                        <figure class="d-flex justify-content-center">
                            <img src="images/hands-gray.png" alt="">
                            <img src="images/hands-white.png" alt="">
                        </figure>

                        <header class="entry-header">
                            <h3 class="entry-title">Bağışçı Ol</h3>
                        </header>

                        <div class="entry-content">
                            <p>Bu güzel işlerimizde sizlerde bize destek olabilirsiniz. </p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <div class="icon-box">
                        <figure class="d-flex justify-content-center">
                            <img src="images/donation-gray.png" alt="">
                            <img src="images/donation-white.png" alt="">
                        </figure>

                        <header class="entry-header">
                            <h3 class="entry-title">Mutluluk Ver</h3>
                        </header>

                        <div class="entry-content">
                            <p>Yardımlarınızda bir çok insan hayata daha mutlu bakıyor.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <div class="icon-box">
                        <figure class="d-flex justify-content-center">
                            <img src="images/charity-gray.png" alt="">
                            <img src="images/charity-white.png" alt="">
                        </figure>

                        <header class="entry-header">
                            <h3 class="entry-title">Online Bağış</h3>
                        </header>

                        <div class="entry-content">
                            <p>Sizlerde gizli yardımsever olmak istiyorsanız,online bağış yapabilirsiniz. </p>
                        </div>
                    </div>
                </div>
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .home-page-icon-boxes -->

    <div class="home-page-welcome">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 order-2 order-lg-1">
                    <div class="welcome-content">
                        <header class="entry-header">
                            <h2 class="entry-title">Bağışçım Ol'a Hoşgeldiniz</h2>
                        </header><!-- .entry-header -->

                        <div class="entry-content mt-5">
                            <p>Öncelikle <a href="{{route('anasayfa')}}">Bağışçım Ol</a>'a hoşgeldiniz.Amacımız Türkiye'de ve dünyada yardıma ihtayacı olan herkese ulaşabilmek,onları bir nebze olsun rahatlığa kavuşturmak,yüzlerinde tebessüm bırakabilmektir.<br>Sizlerde bağışta bulunarak bu güzel işe katkıda bulunabilirsiniz.</p>
                        </div><!-- .entry-content -->

                        <div class="entry-footer mt-5">
                            <a href="{{route('hakkimizda')}}" class="btn gradient-bg mr-2">Detaylı Bilgi</a>
                        </div><!-- .entry-footer -->
                    </div><!-- .welcome-content -->
                </div><!-- .col -->

                <div class="col-12 col-lg-6 mt-4 order-1 order-lg-2">
                    <img src="images/welcome.jpg" alt="welcome">
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .home-page-icon-boxes -->

    <div class="home-page-events">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="upcoming-events">
                        <div class="section-heading">
                            <h2 class="entry-title">Yaklaşan Bağışlar</h2>
                        </div><!-- .section-heading -->
                            @foreach(anasayfa::yaklasan_bagislar() as $yaklasan_bagis)
                            <div class="event-wrap d-flex flex-wrap justify-content-between">
                                <figure class="m-0">
                                    <img src="{{$yaklasan_bagis->bagis_resmi}}" alt="">
                                </figure>

                                <div class="event-content-wrap">
                                    <header class="entry-header d-flex flex-wrap align-items-center">
                                        <h3 class="entry-title w-100 m-0"><a href="{{route('bagislar',['slug'=>$yaklasan_bagis->slug])}}">{{$yaklasan_bagis->bagis_adi}}</a></h3>

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

                                    <div class="entry-footer">
                                        <a href="{{route('bagislar',['slug'=>$yaklasan_bagis->slug])}}">Detaylı Bilgi</a>
                                    </div><!-- .entry-footer -->
                                </div><!-- .event-content-wrap -->
                            </div><!-- .event-wrap -->
                                @endforeach
                    </div><!-- .upcoming-events -->
                </div><!-- .col -->

                <div class="col-12 col-lg-6">
                    <div class="featured-cause">
                        <div class="section-heading">
                            <h2 class="entry-title">Öncelikli Bağış</h2>
                        </div><!-- .section-heading -->

                        <div class="cause-wrap d-flex flex-wrap justify-content-between">
                            <figure class="m-0">
                                <img src="{{$oncelikli_bagis->bagis_resmi}}" alt="">
                            </figure>

                            <div class="cause-content-wrap">
                                <header class="entry-header d-flex flex-wrap align-items-center">
                                    <h3 class="entry-title w-100 m-0"><a href="{{route('bagislar',['slug'=>$oncelikli_bagis->slug])}}">{{$oncelikli_bagis->bagis_adi}}</a></h3>

                                    <div class="posted-date">
                                        <a href="#">{{carbon::parse($oncelikli_bagis->created_at)->format('d.m.Y')}} </a>
                                    </div><!-- .posted-date -->

                                    <div class="cats-links">
                                        <a href="#">{{$oncelikli_bagis->get_kategori->bagis_turu}}</a>
                                    </div><!-- .cats-links -->
                                </header><!-- .entry-header -->

                                <div class="entry-content">
                                    <p class="m-0">{{$oncelikli_bagis->bagis_slogan}}.</p>
                                </div><!-- .entry-content -->

                                <div class="entry-footer mt-5">
                                    <a href="{{route('bagis_yap',['slug'=>$oncelikli_bagis->slug])}}" class="btn gradient-bg mr-2">Bağış Yap</a>
                                </div><!-- .entry-footer -->
                            </div><!-- .cause-content-wrap -->

                            <div class="fund-raised w-100">
                                <div class="featured-fund-raised-bar barfiller">
                                    <div class="tipWrap">
                                        <span class="tip"></span>
                                    </div><!-- .tipWrap -->

                                    <span class="fill" data-percentage="{{anasayfa::bagis_tamamlama_orani($oncelikli_bagis->bagis_tutar,anasayfa::yapilan_bagis_toplami($oncelikli_bagis->id))}}"></span>
                                </div><!-- .fund-raised-bar -->

                                <div class="fund-raised-details d-flex flex-wrap justify-content-between align-items-center">
                                    <div class="fund-raised-total mt-4">
                                        Tamamlanan Tutar: {{anasayfa::turk_parasi_yap(anasayfa::yapilan_bagis_toplami($oncelikli_bagis->id))}}
                                    </div><!-- .fund-raised-total -->

                                    <div class="fund-raised-goal mt-4">
                                        Hedef Tutar: {{anasayfa::turk_parasi_yap($oncelikli_bagis->bagis_tutar)}}
                                    </div><!-- .fund-raised-goal -->
                                </div><!-- .fund-raised-details -->
                            </div><!-- .fund-raised -->
                        </div><!-- .cause-wrap -->
                    </div><!-- .featured-cause -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .home-page-events -->

    <div class="our-causes">
        <div class="container">
            <div class="row">
                <div class="coL-12">
                    <div class="section-heading">
                        <h2 class="entry-title">Diğer Bağışlar</h2>
                    </div><!-- .section-heading -->
                </div><!-- .col -->
            </div><!-- .row -->

            <div class="row">
                <div class="col-12">
                    <div class="swiper-container causes-slider">
                        <div class="swiper-wrapper">
                            @foreach(anasayfa::diger_bagislar() as $diger_bagis)
                            <div class="swiper-slide">
                                <div class="cause-wrap">
                                    <figure class="m-0">
                                        <img src="{{$diger_bagis->bagis_resmi}}" height="300px" alt="">

                                        <div class="figure-overlay d-flex justify-content-center align-items-center position-absolute w-100 h-100">
                                            <a href="{{route('bagis_yap',['slug'=>$diger_bagis->slug])}}" class="btn gradient-bg mr-2">Bağış Yap</a>
                                        </div><!-- .figure-overlay -->
                                    </figure>

                                    <div class="cause-content-wrap">
                                        <header class="entry-header d-flex flex-wrap align-items-center">
                                            <h3 class="entry-title w-100 m-0"><a href="{{route('bagislar',['slug'=>$oncelikli_bagis->slug])}}">{{$diger_bagis->bagis_adi}}</a></h3>
                                        </header><!-- .entry-header -->

                                        <div class="entry-content">
                                            <p class="m-0">{{$diger_bagis->bagis_slogan}}.</p>
                                        </div><!-- .entry-content -->

                                        <div class="fund-raised w-100">
                                            <div class="fund-raised-bar-1 barfiller">
                                                <div class="tipWrap">
                                                    <span class="tip"></span>
                                                </div><!-- .tipWrap -->

                                                <span class="fill" data-percentage="{{anasayfa::bagis_tamamlama_orani($diger_bagis->bagis_tutar,anasayfa::yapilan_bagis_toplami($diger_bagis->id))}}"></span>
                                            </div><!-- .fund-raised-bar -->

                                            <div class="fund-raised-details d-flex flex-wrap justify-content-between align-items-center">
                                                <div class="fund-raised-total mt-4">
                                                    Tamamlanan Tutar: {{anasayfa::turk_parasi_yap(anasayfa::yapilan_bagis_toplami($diger_bagis->id))}}
                                                </div><!-- .fund-raised-total -->

                                                <div class="fund-raised-goal mt-4">
                                                    Hedef Tutar: {{anasayfa::turk_parasi_yap($diger_bagis->bagis_tutar)}}
                                                </div><!-- .fund-raised-goal -->
                                            </div><!-- .fund-raised-details -->
                                        </div><!-- .fund-raised -->
                                    </div><!-- .cause-content-wrap -->
                                </div><!-- .cause-wrap -->
                            </div><!-- .swiper-slide -->
                            @endforeach
                        </div><!-- .swiper-wrapper -->

                    </div><!-- .swiper-container -->

                    <!-- Add Arrows -->
                    <div class="swiper-button-next flex justify-content-center align-items-center">
                        <span><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1171 960q0 13-10 23l-466 466q-10 10-23 10t-23-10l-50-50q-10-10-10-23t10-23l393-393-393-393q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l466 466q10 10 10 23z"/></svg></span>
                    </div>

                    <div class="swiper-button-prev flex justify-content-center align-items-center">
                        <span><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1203 544q0 13-10 23l-393 393 393 393q10 10 10 23t-10 23l-50 50q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l466-466q10-10 23-10t23 10l50 50q10 10 10 23z"/></svg></span>
                    </div>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .our-causes -->

    <div class="home-page-limestone">
        <div class="container">
            <div class="row align-items-end">
                <div class="coL-12 col-lg-6">
                    <div class="section-heading">
                        <h2 class="entry-title">Türkiye'de ve Dünyada problem yaşayan tüm çocuklara yardım etmeyi seviyoruz. 15 yıl sonra elde ettiğimiz birçok hedef var.</h2>


                    </div><!-- .section-heading -->
                </div><!-- .col -->

                <div class="col-12 col-lg-6">
                    <div class="milestones d-flex flex-wrap justify-content-between">
                        <div class="col-12 col-sm-4 mt-5 mt-lg-0">
                            <div class="counter-box">
                                <div class="d-flex justify-content-center align-items-center">
                                    <img src="images/teamwork.png" alt="">
                                </div>

                                <div class="d-flex justify-content-center align-items-baseline">
                                    <div class="start-counter" data-to="{{\App\SiteAyarlari::where('ayar_adi','yardim_sayisi')->first()->deger}}" data-speed="1000"></div>
                                    <div class="counter-k">Bin</div>
                                </div>

                                <h3 class="entry-title">Kişiye Yardım Edildi</h3><!-- entry-title -->
                            </div><!-- counter-box -->
                        </div><!-- .col -->

                        <div class="col-12 col-sm-4 mt-5 mt-lg-0">
                            <div class="counter-box">
                                <div class="d-flex justify-content-center align-items-center">
                                    <img src="images/donation.png" alt="">
                                </div>

                                <div class="d-flex justify-content-center align-items-baseline">
                                    <div class="start-counter" data-to="{{\App\SiteAyarlari::where('ayar_adi','su_kuyusu')->first()->deger}}" data-speed="1000"></div>
                                </div>

                                <h3 class="entry-title">Su Kuyusu Açıldı</h3><!-- entry-title -->
                            </div><!-- counter-box -->
                        </div><!-- .col -->

                        <div class="col-12 col-sm-4 mt-5 mt-lg-0">
                            <div class="counter-box">
                                <div class="d-flex justify-content-center align-items-center">
                                    <img src="images/dove.png" alt="">
                                </div>

                                <div class="d-flex justify-content-center align-items-baseline">
                                    <div class="start-counter" data-to="{{\App\User::selectRaw('COUNT(id) AS KISI')->first()->KISI}}" data-speed="1000"></div>
                                </div>

                                <h3 class="entry-title">Bağışçımız Var</h3><!-- entry-title -->
                            </div><!-- counter-box -->
                        </div><!-- .col -->
                    </div><!-- .milestones -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .our-causes -->

@endsection
