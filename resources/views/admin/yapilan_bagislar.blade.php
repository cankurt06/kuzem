@extends('layouts.admin')
@section('head')
    <title>{{config('app.name')}} | Admin Yapılan Bağışlar</title>
    <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
@stop
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Yapılan Bağışlar</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-xl-6"> <h6 class="m-2 font-weight-bold text-primary">Yapılan Bağışlar Tablosu</h6></div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%">
                    <thead>
                    <tr>
                        <th>Bağış No</th>
                        <th>Bağış Yapan Kişi / TC Kimlik</th>
                        <th>Bağış Adı</th>
                        <th>Bağış Türü</th>
                        <th>Bağış Yapılan Tutar</th>
                        <th>Bağış Durumu</th>
                        <th>Bağış Tarihi</th>
                        <th width="50px">Sil</th>
                        <th width="50px">Ödeme</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Bağış No</th>
                        <th>Bağış Yapan Kişi / TC Kimlik</th>
                        <th>Bağış Adı</th>
                        <th>Bağış Türü</th>
                        <th>Bağış Yapılan Tutar</th>
                        <th>Bağış Durumu</th>
                        <th>Bağış Tarihi</th>
                        <th width="50px">Sil</th>
                        <th width="50px">Ödeme</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach(\App\UserBagis::with('get_bagis_bilgisi')->with('get_bagis_yapan')->orderByDesc('created_at')->get() as $bagis)
                        <tr>
                            <td>{{$bagis->bagis_no}}</td>
                            <td>{{$bagis->get_bagis_yapan->name}} / {{$bagis->get_bagis_yapan->tc_kimlik}}</td>
                            <td>{{$bagis->get_bagis_bilgisi->bagis_adi}}</td>
                            <td>{{$bagis->get_bagis_bilgisi->get_kategori->bagis_turu}}</td>
                            <td>{{anasayfa::turk_parasi_yap($bagis->bagis_tutari)}}</td>
                            <td>{{$bagis->bagis_durumu==1?"Ödendi":"Ödeme Bekliyor"}}</td>
                            <td>{{carbon::parse($bagis->created_at)->format('d.m.Y')}}</td>
                            <td><a href="{{route('odeme_sil',['id'=>$bagis->id])}}" class="btn btn-sm btn-danger bagis_sil"><i class="fas fa-trash"></i> </a></td>
                            <td>@if($bagis->bagis_durumu!=1) <a href="{{route('odeme_yap',['id'=>$bagis->id])}}" class="btn btn-sm btn-primary"><i class="fas fa-thumbs-up"></i> Yap</a> @endif</td>
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