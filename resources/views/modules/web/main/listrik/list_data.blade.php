@extends('layouts.master')

@section('title')
Data Listrik
@endsection

@section('title_content')
Data Listrik
@endsection

@section('external_css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<style>
    .panel-body .row {
        border-bottom: 1px solid #ccc !important;
        border-color: #4285f4 !important
    }

    .modal-header {
        background-color: #4285f4;
        color: white;
        font-weight: 500;
    }

    .field {
        width: 170px;
        font-weight: 400;
        font-style: italic;
    }

    .isi {
        margin: 5px;
        padding: 5px;
    }

</style>
@endsection

@section('content')
<div class="page-head animated fadeInUp" hidden>

    <div style="text-align:-webkit-center" hidden>

        <select name="bulan" id="bulan" class="form-group" style="width:20%;height:34px">

        </select>
        <select name="tahun" id="tahun" class="form-group" style="width:20%;height:34px">

        </select>
        <br>
        {{-- <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
        <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button> --}}
    </div>
</div>
<div class="row animated fadeInDown">
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
    </div>
    @endif
    <div class="col-md-12">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">List Data
                <div class="tools">
                    <a href="/listrik-export/"><span class="icon mdi mdi-download"></span></a>
                    <span class="icon mdi mdi-more-vert" id="listrik_view" url="/listrik/detail"></span>
                </div>
            </div>
            <div class="panel-body table-responsive fix" style="padding:2%">
                <table class="table" id="listrik" url="/listrik/data/">
                    <thead class="animated fadeIn delay-1s">
                        <tr>
                            <th>No</th>
                            <th>ID Pelanggan</th>
                            <th>Nama Pelanggan</th>
                            <th>Alamat Pelanggan</th>
                            <th>No. Meter</th>
                            <th>Kota</th>
                            <th>Witel</th>
                            <th>Divre</th>
                            <th>Area PINS</th>
                            <th style="text-align:center"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@include('modules.web.main.listrik.modal.modal_view')
@endsection

@section('external_js')
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('js/web/main/listrik/list_data.js')}}"></script>
@endsection
