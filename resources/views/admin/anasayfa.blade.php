@extends('layouts.admin')
@section('head')
    <title>{{config('app.name')}} | Admin Anasayfa</title>
    @stop
@section('content')
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Anasayfa</h1>
        </div>
        <!-- Content Row -->
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Toplam Bağış</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{admin::bagis_sayisi()}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-heart fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Toplanan Bağış Tutarı</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{anasayfa::turk_parasi_yap(admin::toplanan_para())}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-hand-holding-heart fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tamamlanma Oranı</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{admin::toplam_bagis_yuzdesi()}}%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: {{admin::toplam_bagis_yuzdesi()}}%" aria-valuenow="{{admin::toplam_bagis_yuzdesi()}}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-percentage fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Üye Sayısı</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{admin::bagisci_sayisi()}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Son 12 Aylık Yapılan Bağış İstatistiği</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Bağışların Ödeme Durumu</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Bekleyen
                    </span>
                            <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Tamamlanan
                    </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @stop
@section('script')

    <script src="{{asset('admin/vendor/chart.js/Chart.min.js')}}"></script>
    <script>
        var aylar_array={!!json_encode(admin::aylik_istatiktik()["ay"])!!};
        var data_array={{json_encode(admin::aylik_istatiktik()["tutar"])}};
    </script>
    <script src="{{asset('admin/js/demo/chart-area-demo.js')}}"></script>
    <script>
        var bekleyen_oran={{admin::bagis_oranlari()["bekleyen"]}};
        var tamamlanan_oran={{admin::bagis_oranlari()["tamam"]}};
    </script>
    <script src="{{asset('admin/js/demo/chart-pie-demo.js')}}"></script>
@stop