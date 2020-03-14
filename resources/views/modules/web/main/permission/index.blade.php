@extends('layouts.master')

@section('title')
Role Permission
@endsection

@section('title_content')
Role Permission
@endsection

@section('external_css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
@endsection

@section('content')
<!--Tabs-->
<div class="row animated fadeInDown">
    <!--Default Tabs-->
    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading">Data Role & Permission</div>
        <div class="tab-container">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#home" data-toggle="tab">Role</a></li>
            <li><a href="#profile" data-toggle="tab">Permission</a></li>
          </ul>
          <div class="tab-content">
            <div id="home" class="tab-pane active cont">
                <table class="table" id="listrik" url="/ajax-listrik">
                    <thead class="animated fadeIn delay-1s">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Display</th>
                            <th>Related Users</th>
                            <th style="text-align:center"></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div id="profile" class="tab-pane cont">
                <table class="table" id="listrik" url="/ajax-listrik">
                    <thead class="animated fadeIn delay-1s">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Display</th>
                            <th>Related Roles</th>
                            <th style="text-align:center"></th>
                        </tr>
                    </thead>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('external_js')
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
{{-- <script src="js/web/main/listrik/list_data.js"></script> --}}
@endsection
