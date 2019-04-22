@extends('layouts.app')
@section('head')
    <title>{{config('app.name')}} | Bağışlarım</title>
@stop
@section('bodyclass') single-page causes-page @stop
@section('content')
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Bağışlarım</h1>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->

    <div class="contact-page-wrap">
        <div class="container">
            <div class="row" style="padding-top: 25px">
              <div class="col-xl-12">
                  <table class="table table-striped table-bordered">
                      <thead>
                      <tr>
                          <th>Bağış No</th>
                          <th>Bağış Adı</th>
                          <th>Bağış Tutarı</th>
                          <th>Ödeme Durumu</th>
                          <th>Bağış Tarihi</th>
                          <th>Sertifika</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($bagislarim as $bagis)
                          <tr>
                              <td>{{$bagis->bagis_no}}</td>
                              <td>{{$bagis->get_bagis_bilgisi->bagis_adi}}</td>
                              <td>{{anasayfa::turk_parasi_yap($bagis->bagis_tutari)}}</td>
                              @if($bagis->bagis_durumu==1) <td style="color: green;"> Ödendi </td> @else <td style="color:red;"> Ödeme Bekliyor </td> @endif
                              <td>{{carbon::parse($bagis->created_at)->format('d.m.Y')}}</td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
            </div><!-- .row -->
        </div><!-- .container -->
    </div>

@endsection
