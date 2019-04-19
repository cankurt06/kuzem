@extends('layouts.admin')
@section('head')
    <title>{{config('app.name')}} | Admin Üyeler</title>
    <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
@stop
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Üyeler</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-2 font-weight-bold text-primary">Üyeler tablosu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%">
                    <thead>
                    <tr>
                        <th>Adı Soyadı</th>
                        <th>Eposta</th>
                        <th>Telefon</th>
                        <th>Tc Kimlik</th>
                        <th>Üye Tipi</th>
                        <th>Kayıt Tarihi</th>
                        <th width="50px">Sil</th>
                        <th width="120px">Yönetici Yap</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Adı Soyadı</th>
                        <th>Eposta</th>
                        <th>Telefon</th>
                        <th>Tc Kimlik</th>
                        <th>Üye Tipi</th>
                        <th>Kayıt Tarihi</th>
                        <th width="50px">Sil</th>
                        <th width="120px">Yönetici Yap</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach(\App\User::get() as $uye)
                        <tr>
                            <td>{{$uye->name}}</td>
                            <td>{{$uye->email}}</td>
                            <td>{{$uye->telefon}}</td>
                            <td>{{$uye->tc_kimlik}}</td>
                            <td>{{$uye->admin_user==1?"Admin":"Bağışçı"}}</td>
                            <td>{{carbon::parse($uye->created_at)->format('d.m.Y')}}</td>
                            <td><a href="{{route('kullanici_sil',['id'=>$uye->id])}}" class="btn btn-sm btn-danger user_sil"><i class="fas fa-trash"></i> </a></td>
                            <td>@if($uye->admin_user==0)<a href="#" class="btn btn-sm btn-success"><i class="fas fa-user-shield "></i> </a>@endif</td>
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
        $('.user_sil').on('click', function (e) {
            e.preventDefault();
            var link = $(this).attr('href');
            Swal.fire({
                title: 'Kullanıcı Silinecek \nOnaylıyor Musunuz ?',
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