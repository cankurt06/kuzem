@extends('layouts.admin')
@section('head')
    <title>{{config('app.name')}} | Admin Haber Ekle</title>
    <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/jquery-ui.min.css')}}" rel="stylesheet">
@stop
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Haber Ekle</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-xl-6"> <h6 class="m-2 font-weight-bold text-primary">Haber Ekle</h6></div>
            </div>
        </div>
        <div class="card-body">
            <form autocomplete="off" id="haber_ekle_form" action="{{route('haber_ekle_post')}}" method="POST">
                @csrf

            <div class="form-group">
                <label for="haber_baslik" class="col-md-12 col-sm-12 col-xs-12">Haber Başlığı <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <input id="haber_baslik" class="form-control" required="required" name="haber_baslik" value="{{ old('haber_baslik') }}" type="text">
                </div>
            </div>
                <div class="form-group">
                    <label for="haber_tarihi" class="col-md-12 col-sm-12 col-xs-12">Haber Tarihi <span class="required">*</span></label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input id="haber_tarihi" class="form-control" required="required" name="haber_tarihi" value="{{ old('haber_tarihi') }}" type="text">
                    </div>
                </div>
            <div class="form-group">
                <label for="haber_icerik" class="col-md-12 col-sm-12 col-xs-12">Haber İçeriği</label>
                <div class="col-md-12 col-xs-12">
                    <textarea name="haber_icerik" id="haber_icerik"></textarea>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-success gorsel" type="button" onclick="openKCFinder(anasayfa_resim_div,$('#haber_resim_url'))">Haber Görsel Seç</button>
                <button class="btn btn-danger gorsel" type="button" id="ana_gorsel_sil">Görsel Sil</button>
                <label class="text-danger"> *Önerilen Boyut 1920x830 pixel </label>
                <div id="anasayfa_resim_div" onclick="window.open($('#haber_resim_url').val())"></div>
                <input type="hidden" name="haber_resim_url" id="haber_resim_url" value="{{old('haber_resim_url')}}"/>
            </div>
            <hr>
                <div class="float-right">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Kaydet</button>
                </div>
            </form>
        </div>
    </div>
@stop
@section('script')
    <script type="text/javascript" src="{{Url('ck/ckeditor.js')}}"></script>
    <script type="text/javascript" src="{{Url('admin/js/jquery-ui.min.js')}}"></script>
    <script> CKEDITOR.replace('haber_icerik', {
            filebrowserBrowseUrl: '{{Url('kcfinder/browse.php?opener=ckeditor&type=files')}}',
            filebrowserUploadUrl: '{{Url('kcfinder/upload.php?opener=ckeditor&type=files')}}',
            height: '300px',

        });
    </script>
    <script>
        $(function () {
            $("#haber_tarihi").datepicker({
                showButtonPanel: true,
                changeMonth: true,
                changeYear: true,
            });
        });
        function openKCFinder(div,url_div) {
            window.KCFinder = {
                callBack: function(url) {
                    url_div.val(url);
                    window.KCFinder = null;
                    div.innerHTML = '<div style="margin:5px">Yükleniyor...</div>';
                    var img = new Image();
                    img.src = url;
                    img.onload = function() {
                        div.innerHTML = '<img id="img" style="width: 100%;" src="' + url + '" />';
                    }
                }
            };
            window.open("{{asset('kcfinder/browse.php?opener=ckeditor&type=files')}}" ,
                'Resim Seç', 'status=0, toolbar=0, location=0, menubar=0, ' +
                'directories=0, resizable=0, scrollbars=0, width=800, height=600'
            );
        }
        $("#ana_gorsel_sil").on('click',function (e) {
            $("#anasayfa_resim_div").html("");
            $("#haber_resim_url").val("");
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