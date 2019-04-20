@extends('layouts.admin')
@section('head')
    <title>{{config('app.name')}} | Admin Bağış Düzenle</title>
    <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/jquery-ui.min.css')}}" rel="stylesheet">
@stop
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Bağış Düzenle</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-xl-6"> <h6 class="m-2 font-weight-bold text-primary">Bağış Düzenle</h6></div>
            </div>
        </div>
        <div class="card-body">
            <form autocomplete="off" id="bagis_duzenle_form" action="{{route('bagis_duzenle_post')}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$bagis->id}}">
            <div class="form-group">
                <label for="bagis_adi" class="col-md-12 col-sm-12 col-xs-12">Bağış Adı <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <input id="bagis_adi" class="form-control" required="required" name="bagis_adi" value="{{$bagis->bagis_adi}}" type="text">
                </div>
            </div>
                <div class="form-group">
                    <label for="bagis_tarihi" class="col-md-12 col-sm-12 col-xs-12">Bağış Tarihi <span class="required">*</span></label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input id="bagis_tarihi" class="form-control" required="required" name="bagis_tarihi" value="{{ carbon::parse($bagis->created_at)->format('d.m.Y')}}" type="text">
                    </div>
                </div>
            <div class="form-group">
                <label for="bagis_slogan" class="col-md-12 col-sm-12 col-xs-12">Bağış Slogan </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <input id="bagis_slogan" class="form-control" name="bagis_slogan" value="{{$bagis->bagis_slogan}}" type="text">
                </div>
            </div>
            <div class="form-group">
                <label for="bagis_turu" class="col-md-12 col-sm-12 col-xs-12">Bağış Türü </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <select name="bagis_turu" id="bagis_turu" class="form-control">
                      @foreach(\App\BagisKategori::get() as $bagis_turu)
                          <option value="{{$bagis_turu->id}}" @if($bagis->$bagis_turu==$bagis_turu->id) selected @endif >{{$bagis_turu->bagis_turu}}</option>
                          @endforeach
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label for="bagis_tutar" class="col-md-12 col-sm-12 col-xs-12">Bağış Tutarı <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <input id="bagis_tutar" class="form-control" required="required" name="bagis_tutar" value="{{$bagis->bagis_tutar}}" type="text">
                </div>
            </div>
            <div class="form-group">
                <label for="onemli_bagis" class="col-md-12 col-sm-12 col-xs-12">Önemli Bağış </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <input id="onemli_bagis"  name="onemli_bagis" type="checkbox" @if($bagis->onemli_bagis==1) checked @endif > Evet
                </div>
            </div>
                <div class="form-group">
                    <label for="bagis_tamamlandi" class="col-md-12 col-sm-12 col-xs-12">Bağış Tamamlandı </label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input id="bagis_tamamlandi"  name="bagis_tamamlandi" type="checkbox" @if($bagis->bagis_tamamlandi==1) checked @endif > Evet
                    </div>
                </div>
            <div class="form-group">
                <label for="onemli_bagis" class="col-md-12 col-sm-12 col-xs-12">Bağış Detayları</label>
                <div class="col-md-12 col-xs-12">
                    <textarea name="bagis_icerik" id="bagis_icerik">{{$bagis->bagis_icerik}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-success gorsel" type="button" onclick="openKCFinder(anasayfa_resim_div,$('#anasayfa_resim_url'))">Slayt Görsel Seç</button>
                <button class="btn btn-danger gorsel" type="button" id="ana_gorsel_sil">Görsel Sil</button>
                <label class="text-danger"> *Önerilen Boyut 1920x830 pixel </label>
                <div id="anasayfa_resim_div" onclick="window.open($('#anasayfa_resim_url').val())"><img src="{{asset($bagis->slayt_resmi)}}" width="250px" style="margin-top: 15px"> </div>
                <input type="hidden" name="slayt_resmi" id="anasayfa_resim_url" value="{{$bagis->slayt_resmi}}"/>
            </div>
            <hr>
            <div class="form-group">
                <button class="btn btn-success gorsel" type="button" onclick="openKCFinder(haberler_resim_div,$('#haberler_resim_url'))">Bağış Görsel Seç</button>
                <button class="btn btn-danger gorsel" type="button" id="tum_gorsel_sil">Görsel Sil</button>
                <label class="text-danger"> *Önerilen Boyut 250x300 pixel </label>
                <div id="haberler_resim_div" onclick="window.open($('#haberler_resim_url').val())"><img src="{{asset($bagis->bagis_resmi)}}" width="250px" style="margin-top: 15px"></div>
                <input type="hidden" name="bagis_resmi" id="haberler_resim_url" value="{{$bagis->bagis_resmi}}"/>
            </div>
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
    <script> CKEDITOR.replace('bagis_icerik', {
            filebrowserBrowseUrl: '{{Url('kcfinder/browse.php?opener=ckeditor&type=files')}}',
            filebrowserUploadUrl: '{{Url('kcfinder/upload.php?opener=ckeditor&type=files')}}',
            height: '300px',

        });
    </script>
    <script>
        $(function () {
            $("#bagis_tarihi").datepicker({
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
        $("#tum_gorsel_sil").on('click',function (e) {
            $("#haberler_resim_div").html("");
            $("#haberler_resim_url").val("");
        });
        $("#ana_gorsel_sil").on('click',function (e) {
            $("#anasayfa_resim_div").html("");
            $("#anasayfa_resim_url").val("");
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