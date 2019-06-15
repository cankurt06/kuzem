@extends('layouts.admin')
@section('head')
    <title>{{config('app.name')}} | Admin Haberler</title>
    <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
@stop
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Haberler</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-xl-6"> <h6 class="m-2 font-weight-bold text-primary">Haberler tablosu</h6></div>
                <div class="col-xl-6"><a class="btn btn-success float-right" href="{{route('haber_ekle')}}">Yeni Haber Ekle</a></div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%">
                    <thead>
                    <tr>
                        <th>Haber Resmi</th>
                        <th>Haber Başlığı</th>
                        <th>Haber Adresi</th>
                        <th>Haber Tarihi</th>
                        <th width="50px">Sil</th>
                        <th width="50px">Düzenle</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($haberler as $haber)
                        <tr>
                            <td style="max-width: 100px"><img style="width: 100%;" src="{{asset($haber->haber_resim_url)}}" alt="{{$haber->haber_baslik}}"> </td>
                            <td>{{$haber->haber_baslik}}</td>
                            <td><a href="{{route('haberler',['slug'=>$haber->slug])}}" target="_blank">{{$haber->slug}}</a></td>
                            <td>{{carbon::parse($haber->created_at)->format('d.m.Y')}}</td>
                            <td><a href="{{route('haber_sil',['id'=>$haber->id])}}" class="btn btn-sm btn-danger haber_sil"><i class="fas fa-trash"></i> </a></td>
                            <td><a href="{{route('haber_duzenle',['id'=>$haber->id])}}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> </a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop
@section('script')
    <script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/js/demo/datatables-demo.js')}}"></script>
    <script>
        $('.haber_sil').on('click', function (e) {
            e.preventDefault();
            var link = $(this).attr('href');
            Swal.fire({
                title: 'Haber Silinecek \nOnaylıyor Musunuz ?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sil!',
                cancelButtonText: 'İptal'
            }).then((result) => {
                if (result.value) {
                    window.location.href = link;
                }
            })
        });
    </script>
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