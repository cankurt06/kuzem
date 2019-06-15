@extends('layouts.app')
@section('head')
    <title>{{config('app.name')}} | Haberler</title>
@stop
@section('bodyclass') single-page news-page @stop
@section('content')
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Haberler</h1>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->

    <div class="news-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12">
                    @if(count($haberler)>0)
                    @foreach($haberler as $haber)
                    <div class="news-content">
                        <img src="{{asset($haber->haber_resim_url)}}" alt="">

                        <header class="entry-header d-flex flex-wrap justify-content-between align-items-center">
                            <div class="header-elements">
                                <div class="posted-date">{{carbon::parse($haber->created_at)->format('d.m.Y')}}</div>

                                <h2 class="entry-title"><a href="{{route('haberler',['slug'=>$haber->slug])}}">{{$haber->haber_baslik}}</a></h2>

                                <div class="post-metas d-flex flex-wrap align-items-center">
                                    <span class="post-author">Yazar {{$haber->haber_yazari->name}}</span>
                                </div>
                            </div>
                        </header>

                        <div class="entry-content">
                            <p>{!! $haber->haber_icerik !!}</p>
                        </div>

                        <footer class="entry-footer">
                            <a href="{{route('haberler',['slug'=>$haber->slug])}}" class="btn gradient-bg">Devamını Oku</a>
                        </footer>
                    </div>
                    @endforeach
                    <div class="col-md-12 text-center">
                        {{ $haberler->links('vendor.pagination.bootstrap-4') }}
                    </div>
                        @else
                        <h1>Haber Bulunamadı</h1>
                   @endif
                    <!--<ul class="pagination d-flex flex-wrap align-items-center p-0">
                        <li class="active"><a href="#">01</a></li>
                        <li><a href="#">02</a></li>
                        <li><a href="#">03</a></li>
                    </ul>-->
                </div>
            </div>
        </div>
    </div>

@endsection
