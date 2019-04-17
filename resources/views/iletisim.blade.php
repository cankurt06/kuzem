@extends('layouts.app')
@section('head')
    <title>{{config('app.name')}} | İletişim</title>
@stop
@section('bodyclass') single-page causes-page @stop
@section('content')
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>İletişim</h1>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->

    <div class="contact-page-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-5">
                    <div class="entry-content">
                        <h2>Bize Ulaşın</h2>

                        <p>Düşünce ve fikirlerinizi bizimle paylaşabilir, sistem hakkında bilgi alabilirsiniz.</p>

                        <ul class="contact-social d-flex flex-wrap align-items-center">
                            <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-behance"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>

                        <ul class="contact-info p-0">
                            <li><i class="fa fa-phone"></i><span>+90 312 111 1 111</span></li>
                            <li><i class="fa fa-envelope"></i><span>iletisim@kuzemodevim.site</span></li>
                            <li><i class="fa fa-map-marker"></i><span>Kızılay Mah. 1. Cad. No:1/1 Çankaya/ANKARA</span></li>
                        </ul>
                    </div>
                </div><!-- .col -->

                <div class="col-12 col-lg-7">
                    <form class="contact-form">
                        <input type="text" placeholder="İsim">
                        <input type="email" placeholder="Eposta">
                        <textarea rows="15" cols="6" placeholder="Mesaj"></textarea>

                        <span>
                            <input class="btn gradient-bg" type="submit" value="Gönder">
                        </span>
                    </form><!-- .contact-form -->

                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div>

@endsection
