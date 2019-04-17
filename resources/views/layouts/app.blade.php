<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <!-- ElegantFonts CSS -->
    <link rel="stylesheet" href="{{asset('css/elegant-fonts.css')}}">
    <!-- themify-icons CSS -->
    <link rel="stylesheet" href="{{asset('css/themify-icons.css')}}">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{asset('css/swiper.min.css')}}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    @yield("head")
</head>
<body class="@yield("bodyclass")">
<header class="site-header">
    <div class="top-header-bar">
        <div class="container">
            <div class="row flex-wrap justify-content-center justify-content-lg-between align-items-lg-center">
                <div class="col-12 col-lg-8 d-none d-md-flex flex-wrap justify-content-center justify-content-lg-start mb-3 mb-lg-0">
                    <div class="header-bar-email">
                        EPOSTA: <a href="mailto:iletisim@kuzemodevim.site">iletisim@kuzemodevim.site</a>
                    </div><!-- .header-bar-email -->

                    <div class="header-bar-text">
                        <p>TELEFON: <span>+90 312 111 1 111</span></p>
                    </div><!-- .header-bar-text -->
                </div><!-- .col -->

                <div class="col-12 col-lg-4 d-flex flex-wrap justify-content-center justify-content-lg-end align-items-center">
                    <div class="donate-btn">
                        <a href="#"><i class="fa fa-heart-o"></i> Bağış Yap</a>
                    </div><!-- .donate-btn -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .top-header-bar -->

    <div class="nav-bar">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                    <div class="site-branding d-flex align-items-center">
                        <a class="d-block" href="{{route('anasayfa')}}" rel="anasayfa"><img class="d-block" src="{{asset('images/logo.png')}}" alt="logo"></a>
                    </div><!-- .site-branding -->

                    <nav class="site-navigation d-flex justify-content-end align-items-center">
                        <ul class="d-flex flex-column flex-lg-row justify-content-lg-end align-content-center">
                            <li @if(Route::getFacadeRoot()->current()->getName()=="anasayfa") class="current-menu-item" @endif ><a href="{{route('anasayfa')}}">Anasayfa</a></li>
                            <li @if(Route::getFacadeRoot()->current()->getName()=="hakkimizda") class="current-menu-item" @endif ><a href="{{route('hakkimizda')}}">Hakkımızda</a></li>
                            <li @if(Route::getFacadeRoot()->current()->getName()=="bagislar") class="current-menu-item" @endif ><a href="{{route('bagislar')}}">Bağışlar</a></li>
                            <li @if(Route::getFacadeRoot()->current()->getName()=="haberler") class="current-menu-item" @endif ><a href="{{route('haberler')}}">Haberler</a></li>
                            <li @if(Route::getFacadeRoot()->current()->getName()=="iletisim") class="current-menu-item" @endif ><a href="{{route('iletisim')}}">İletişim</a></li>
                            @if(Auth::check())
                        </ul>
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle menu-profil"  href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="#">Profilim</a>
                                        <a class="dropdown-item" href="#">Bağışlarım</a>
                                        <a class="dropdown-item" href="{{route('cikis')}}">Çıkış Yap</a>
                                    </div>
                                </div>
                                @else
                                <li @if(Route::getFacadeRoot()->current()->getName()=="login") class="current-menu-item" @endif ><a href="{{route('login')}}">Giriş Yap</a></li>
                        </ul>
                                @endif

                    </nav><!-- .site-navigation -->

                    <div class="hamburger-menu d-lg-none">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div><!-- .hamburger-menu -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .nav-bar -->
</header><!-- .site-header -->
@yield("content")
<footer class="site-footer">
    <div class="footer-widgets">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="foot-about">
                        <h2><a class="foot-logo" href="#"><img src="{{asset('images/foot-logo.png')}}" alt=""></a></h2>

                        <p>Bizlere,yardım kampanyalarımızı sosyal medyalarda paylaşarak,sayfalarımızı beğenerek de destek olabilirsiniz.</p>

                        <ul class="d-flex flex-wrap align-items-center">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                        </ul>
                    </div><!-- .foot-about -->
                </div><!-- .col -->

                <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
                    <div class="foot-latest-news">
                        <h2>Yeni Bağışlar</h2>

                        <ul>
                            <li>
                                <h3><a href="#">A new cause to help</a></h3>
                                <div class="posted-date">MArch 12, 2018</div>
                            </li>

                            <li>
                                <h3><a href="#">We love to help people</a></h3>
                                <div class="posted-date">MArch 12, 2018</div>
                            </li>

                            <li>
                                <h3><a href="#">The new ideas for helping</a></h3>
                                <div class="posted-date">MArch 12, 2018</div>
                            </li>
                        </ul>
                    </div><!-- .foot-latest-news -->
                </div><!-- .col -->

                <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
                    <div class="foot-latest-news">
                        <h2>Yeni Haberler</h2>

                        <ul>
                            <li>
                                <h3><a href="#">A new cause to help</a></h3>
                                <div class="posted-date">MArch 12, 2018</div>
                            </li>

                            <li>
                                <h3><a href="#">We love to help people</a></h3>
                                <div class="posted-date">MArch 12, 2018</div>
                            </li>

                            <li>
                                <h3><a href="#">The new ideas for helping</a></h3>
                                <div class="posted-date">MArch 12, 2018</div>
                            </li>
                        </ul>
                    </div><!-- .foot-latest-news -->
                </div><!-- .col -->

                <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
                    <div class="foot-contact">
                        <h2>İletişim</h2>
                        <ul>
                            <li><i class="fa fa-phone"></i><span>+90 312 111 1 111</span></li>
                            <li><i class="fa fa-envelope"></i><span>iletisim@kuzemodevim.site</span></li>
                            <li><i class="fa fa-map-marker"></i><span>Kızılay Mah. 1. Cad. No:1/1 Çankaya/ANKARA</span></li>
                        </ul>
                    </div><!-- .foot-contact -->

                    <div class="subscribe-form">
                        <form class="d-flex flex-wrap align-items-center">
                            <label>Bağışları Takip Et</label>
                            <input type="email" placeholder="Eposta Adresiniz">
                            <input type="submit" value="Gönder">
                        </form><!-- .flex -->
                    </div><!-- .search-widget -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .footer-widgets -->

    <div class="footer-bar">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Tüm Hakları Saklıdır &copy; <script>document.write(new Date().getFullYear());</script> | <i class="fa fa-heart-o" aria-hidden="true"></i> Bağışçım Ol
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div><!-- .col-12 -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .footer-bar -->
</footer><!-- .site-footer -->
<script type='text/javascript' src='{{asset('js/jquery.js')}}'></script>
<script type='text/javascript' src='{{asset('js/jquery.collapsible.min.js')}}'></script>
<script type='text/javascript' src='{{asset('js/swiper.min.js')}}'></script>
<script type='text/javascript' src='{{asset('js/jquery.countdown.min.js')}}'></script>
<script type='text/javascript' src='{{asset('js/circle-progress.min.js')}}'></script>
<script type='text/javascript' src='{{asset('js/jquery.countTo.min.js')}}'></script>
<script type='text/javascript' src='{{asset('js/jquery.barfiller.js')}}'></script>
<script type='text/javascript' src='{{asset('js/popper.min.js')}}'></script>
<script type='text/javascript' src='{{asset('js/bootstrap.min.js')}}'></script>
<script type='text/javascript' src='{{asset('js/custom.js')}}'></script>
</body>
</html>
