@extends('layouts.app')
@section('head')
    <title>{{config('app.name')}} | {{$haber->haber_baslik}}</title>
@stop
@section('bodyclass') single-page news-page @stop
@section('content')
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>{{$haber->haber_baslik}}</h1>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->

    <div class="news-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="news-content">
                      <img src="{{asset($haber->haber_resim_url)}}" alt="">

                        <header class="entry-header d-flex flex-wrap justify-content-between align-items-center">
                            <div class="header-elements">
                                <div class="posted-date">{{carbon::parse($haber->created_at)->format('d.m.Y')}}</div>

                                <div class="post-metas d-flex flex-wrap align-items-center">
                                    <span class="post-author">Yazar {{$haber->haber_yazari->name}}</span>
                                </div>
                            </div>
                        </header>

                        <div class="entry-content">
                            {!! $haber->haber_icerik !!}
                        </div>
                    </div>
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
