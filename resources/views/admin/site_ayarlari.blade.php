@extends('layouts.admin')
@section('head')
    <title>{{config('app.name')}} | Admin Site Ayarları</title>
    <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
@stop
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Site Ayarları</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-xl-6"><h6 class="m-2 font-weight-bold text-primary">Site Ayarları</h6></div>
            </div>
        </div>
        <div class="card-body">
            <form autocomplete="off" id="site_ayarlari_duzenle_form" action="{{route('site_ayarlari_duzenle')}}" method="POST">
                @csrf
            @foreach($site_ayarlari as $ayar)
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{$ayar->ayar_adi}}</label>
                    <input class="col-md-3 form-control" name="site_ayar[{{$ayar->ayar_adi}}]" type="text" value="{{$ayar->deger}}"/>
                </div>
            @endforeach
                <hr>
                <div class="float-right">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Kaydet</button>
                </div>
            </form>
        </div>
    </div>

@stop
@section('script')
    @if(session('sonuc'))
        <script>
            Swal.fire({
                type: '{{session('sonuc')[0]}}',
                title: '{{session('sonuc')[1]}}',
                confirmButtonText: 'Tamam'
            })
        </script>
    @endif
@stop