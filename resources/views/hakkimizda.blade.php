@extends('layouts.app')
@section('head')
    <title>{{config('app.name')}} | Hakkımızda</title>
@stop
@section('bodyclass') single-page about-page @stop
@section('content')
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Hakkımızda</h1>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->

    <div class="welcome-wrap">
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

                    </div><!-- .welcome-content -->
                </div><!-- .col -->

                <div class="col-12 col-lg-6 order-1 order-lg-2">
                    <img src="images/welcome.jpg" alt="welcome">
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .home-page-icon-boxes -->

    <div class="about-stats">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="circular-progress-bar">
                        <div class="circle" id="loader_1">
                            <strong class="d-flex justify-content-center"></strong>
                        </div>

                        <h3 class="entry-title">Zor İşler</h3>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="circular-progress-bar">
                        <div class="circle" id="loader_2">
                            <strong class="d-flex justify-content-center"></strong>
                        </div>

                        <h3 class="entry-title">Görev Tamamlama</h3>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="circular-progress-bar">
                        <div class="circle" id="loader_3">
                            <strong class="d-flex justify-content-center"></strong>
                        </div>

                        <h3 class="entry-title">Akıllıca Fikirler</h3>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="circular-progress-bar">
                        <div class="circle" id="loader_4">
                            <strong class="d-flex justify-content-center"></strong>
                        </div>

                        <h3 class="entry-title">Doğru Kararlar</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="about-testimonial">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="testimonial-cont">
                        <div class="entry-content">
                            <p>İyiki Varsınız BağışcıOl.<br>Sayenizde yüzlerce kişiye bağış yaptım.</p>
                        </div>

                        <div class="entry-footer d-flex flex-wrap align-items-center mt-5">
                            <img src="images/testimonial-1.jpg" alt="">

                            <h4>Ayşe GÜZEL, <span>Bağışçı</span></h4>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 offset-lg-2 col-lg-5">
                    <div class="testimonial-cont">
                        <div class="entry-content">
                            <p>Dünyada problem yaşayan tüm çocuklara yardım etmeyi seviyoruz.</p>
                        </div>

                        <div class="entry-footer d-flex flex-wrap align-items-center mt-5">
                            <img src="images/testimonial-2.jpg" alt="">

                            <h4>Ali YILDIRIM, <span>Bağışçı</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="help-us">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                    <h2>Başkalarına da yardım etmek için,</h2>

                    <a class="btn orange-border" href="{{route('bagislar')}}">Bağış Yap</a>
                </div>
            </div>
        </div>
    </div>








@endsection
