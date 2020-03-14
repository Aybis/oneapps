@extends('layouts.master')

@section('title')
Dashboard NOC
@endsection

@section('title_content')
Dashboard NOC
@endsection

@section('external_css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<!-- Styles -->
<style>
    #chartmiss {
        width: 100%;
        height: 400px;
    }
    #chartmet {
        width: 100%;
        height: 400px;
    }

</style>
<!-- Resources -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
@endsection

@section('content')
<div class="page-head animated fadeInUp">

    <div style="text-align:-webkit-center">

        <select name="bulan" id="bulan" class="form-group" style="width:20%;height:34px">

        </select>
        <select name="tahun" id="tahun" class="form-group" style="width:20%;height:34px">

        </select>
        <input type="hidden" id="url_filter" url="/noc/data-chart/">
    <input type="hidden" id="token" value="{{ csrf_token()}}">
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6 animated fadeInRight">
        <div class="widget be-loading">
            <div class="widget-head">
                <div class="tools"><span class="icon mdi mdi-chevron-down"></span><span
                        class="icon mdi mdi-refresh-sync toggle-loading"></span><span class="icon mdi mdi-close"></span>
                </div>
                <div class="title">All Data</div>
            </div>
            <div class="widget-chart-container">
                <div id="chartmet">

                </div>
            </div>

            <div class="be-spinner">
                <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                    <circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle">
                    </circle>
                </svg>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6 animated fadeInLeft" hidden>
        <div class="widget be-loading">
            <div class="widget-head">
                <div class="tools"><span class="icon mdi mdi-chevron-down"></span><span
                        class="icon mdi mdi-refresh-sync toggle-loading"></span><span class="icon mdi mdi-close"></span>
                </div>
                <div class="title">Data By Segment
                    <div id="status" style="text-align:-webkit-center">
                        <div class="be-radio be-radio-color inline">
                          <input type="radio" checked="" name="miss" id="rad9">
                          <label for="rad9">Miss</label>
                        </div>
                        <div class="be-radio be-radio-color inline">
                          <input type="radio" name="met" id="rad10">
                          <label for="rad10">Met</label>
                        </div>
                      </div>
                </div>

            </div>
            <div class="widget-chart-container">
                <div id="chartmiss">

                </div>
            </div>
            <div class="be-spinner">
                <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                    <circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle">
                    </circle>
                </svg>
            </div>
        </div>
    </div>
</div>


<div class="row animated fadeInDown">
    <div class="col-md-12">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">LIST DATA
                <div class="tools">
                    <span class="icon mdi mdi-download"></span>
                    <span class="icon mdi mdi-more-vert"></span>
                </div>
            </div>
            <div class="panel-body table-responsive fix" style="padding:2%">
                <table id="dashboard" class="table" url="/noc/dashboard-table">
                    <thead class="animated fadeIn delay-1s">
                        <tr>
                            <th>No</th>
                            <th>No Ticket</th>
                            <th>Customer</th>
                            <th>Layanan</th>
                            <th>Segment</th>
                            <th>Open Ticket</th>
                            <th>Durasi Pending</th>
                            <th>Resolved Ticket</th>
                            <th>Close Ticket</th>
                            <th style="text-align:center"> Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- @include('modules.web.main.listrik.modal.modal_view') --}}
@endsection

@section('external_js')
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('js/web/main/noc/dashboard.js')}}"></script>
<script src="{{ asset('js/web/main/noc/filter.js')}}"></script>
<script src="{{ asset('js/web/main/noc/chart_met.js')}}"></script>
<script src="{{ asset('js/web/main/noc/chart_miss.js')}}"></script>
@endsection
