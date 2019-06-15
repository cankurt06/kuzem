@extends('layouts.admin')
@section('head')
    <title>{{config('app.name')}} | Admin Bağışlar</title>
    <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
@stop
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Bağışlar</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-xl-6"> <h6 class="m-2 font-weight-bold text-primary">Bağışlar tablosu</h6></div>
                <div class="col-xl-6"><a class="btn btn-success float-right" href="{{route('bagis_ekle')}}">Yeni Bağış Ekle</a></div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%">
                    <thead>
                    <tr>
                        <th>Bağış Adı</th>
                        <th>Bağış Slogan</th>
                        <th>Bağış Türü</th>
                        <th>Hedef Tutar</th>
                        <th>Toplanan Tutar</th>
                        <th>Bağış Durumu</th>
                        <th>Bağış Baş. Tarihi</th>
                        <th width="50px">Sil</th>
                        <th width="50px">Düzenle</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Bagislar::with('get_kategori')->orderByDesc('created_at')->get() as $bagis)
                        <tr>
                            <td>{{$bagis->bagis_adi}}</td>
                            <td>{{$bagis->bagis_slogan}}</td>
                            <td>{{$bagis->get_kategori->bagis_turu}}</td>
                            <td>{{anasayfa::turk_parasi_yap($bagis->bagis_tutar)}}</td>
                            <td>{{anasayfa::turk_parasi_yap(anasayfa::yapilan_bagis_toplami($bagis->id))}}</td>
                            <td>{{$bagis->bagis_tamamlandi==1?"Tamamlandı":"Devam Ediyor"}}</td>
                            <td>{{carbon::parse($bagis->created_at)->format('d.m.Y')}}</td>
                            <td><a href="{{route('bagis_sil',['id'=>$bagis->id])}}" class="btn btn-sm btn-danger bagis_sil"><i class="fas fa-trash"></i> </a></td>
                            <td><a href="{{route('bagis_duzenle',['id'=>$bagis->id])}}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> </a></td>
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
        $('.bagis_sil').on('click', function (e) {
            e.preventDefault();
            var link = $(this).attr('href');
            Swal.fire({
                title: 'Bağış Silinecek \nOnaylıyor Musunuz ?',
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