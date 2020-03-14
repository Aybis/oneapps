@extends('layouts.master')

@section('title')
Data Listrik
@endsection

@section('title_content')
Data Listrik
@endsection

@section('external_css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

@endsection

@section('content')
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
                    <a href="#"><span class="icon mdi mdi-more-vert"></span></a>
                </div>
            </div>
            <div class="panel-body table-responsive fix" style="padding:2%">
                <table class="table" id="listrik" url="/ajax-listrik">
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
@endsection

@section('external_js')
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
@endsection
