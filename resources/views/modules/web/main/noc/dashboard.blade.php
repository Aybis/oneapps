@extends('layouts.master')

@section('title')
Dashboard NOC
@endsection

@section('title_content')
Dashboard NOC
@endsection

@section('external_css')
<!-- datatable/ -->

<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/select2/css/select2.min.css')}}" />
<!-- external -->
<link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" type="text/css" />
{{-- <link rel="stylesheet" href="{{ asset('assets/css/app.css')}}" type="text/css" /> --}}
<!-- Resources Chart-->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Styles -->
<style>
    #incident {
        width: 100%;
        height: 330px;
    }

    #request {
        width: 100%;
        height: 400px;
    }

</style>

@endsection

@section('content')
<div class="page-head animated fadeInUp">
    @if (count($errors) > 0)

    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div style="text-align:-webkit-center">
        <select name="bulan" id="bulan" class="form-group" style="width:20%;height:34px">
        </select>
        <select name="tahun" id="tahun" class="form-group" style="width:20%;height:34px">
        </select>
        <input type="hidden" id="url_chart_request" data-url="{{ url('/noc/api/request') }}"">
        <input type="hidden" id="url_chart_incident" data-url="{{ url('/noc/api/incident') }}">
    </div>
</div>

<div class="row">

    <div class="col-xs-12 col-md-6 animated fadeInRight fast" id="c">
        <div class="widget be-loading">
            <div class="widget-head">
                <div class="tools">
                    <span class="icon mdi mdi-chevron-down"></span>
                    <span class="icon mdi mdi-refresh-sync toggle-loading" id="toggle-incident"></span>
                    <span class="icon mdi mdi-close"></span>
                </div>
                <div class="title"> Incident Management
                    <div id="status" style="margin-top: 20px;text-align:-webkit-center" >
                        <select name="customer" id="" class="select2 select2-sm">
                            <option value="all">All</option>
                            @foreach ($customer as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="widget-chart-container">
                <!-- new chart incident management -->
                <div id="incident">

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
    <!-- end dib incident -->
    <div class="col-xs-12 col-md-6 animated fadeInLeft fast">
        <div class="widget be-loading">
            <div class="widget-head">
                <div class="tools">
                    <span class="icon mdi mdi-chevron-down"></span>
                    <span class="icon mdi mdi-refresh-sync toggle-loading" id="toggle-request"></span>
                    <span class="icon mdi mdi-close"></span>
                </div>
                <div class="title">Request Fulfillment
                </div>
            </div>
            <div class="widget-chart-container">
                <!-- new chart request fulfillment-->
                <div id="request">

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
    <!-- end div request -->
    <div class="col-xs-12 col-md-12 animated fadeInDown fast">
        <div class="widget be-loading">
            <div class="widget-head">
                <div class="tools">
                    <div class="btn-group btn-hspace">
                        <span class="icon mdi mdi-refresh-sync toggle-loading" id="toggle-table"></span>
                        <a data-toggle="dropdown" class="dropdown-toggle" title="Action">
                            <span class="icon mdi mdi-more-vert"></span>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a data-modal="form-success" class="btn btn-space md-trigger">Import File</a>
                            </li>
                            <li>
                                <a href="#" class="btn ">Download</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="title">List Data
                </div>
            </div>
            <div class="widget-chart-container">
                <div class="panel-body table-responsive fix">
                    <table id="all" class="table" url="{{ url('noc/api/all') }}">
                        <thead>
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
                                <th> Status</th>
                                <th style="text-align:center"> Action</th>
                            </tr>
                        </thead>
                    </table>
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


@include('modules.web.main.noc.incl.modal_upload_excel')
@endsection

@section('external_js')

<!-- datatable/ -->
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<!-- Select2/ -->
<script src="{{ asset('assets/lib/select2/js/select2.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<!-- Nifty Modal -->
{{-- <script src="{{ asset('assets/lib/bootstrap/dist/js/bootstrap.min.js')}}"></script> --}}
<script src="{{ asset('assets/lib/jquery.niftymodals/dist/jquery.niftymodals.js') }}" type="text/javascript"></script>
<!-- External -->
<script src="{{ asset('js/web/main/noc/dashboard.js')}}"></script>
<script src="{{ asset('js/web/main/noc/chart_incident.js')}}"></script>
<script src="{{ asset('js/web/main/noc/chart_request.js')}}"></script>

@endsection
