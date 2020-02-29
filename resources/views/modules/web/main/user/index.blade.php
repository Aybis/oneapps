@extends('layouts.master')
@section('title')
Users
@endsection
@section('title_content')
Data Users
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default panel-table">

            <div class="panel-heading">
                Export Functions
                <div class="tools">
                    <span><a href="/form-users" title="Tambah Users"><i class="icon mdi mdi-plus"></i></a></span>
                    <span class="icon mdi mdi-download"></span>
                    <span class="icon mdi mdi-more-vert"></span>
                </div>
            </div>

            <div class="panel-body">
                <table id="table3" class="table table-striped table-hover table-fw-widget">
                    <thead>
                        <tr>
                            <th>Rendering engine</th>
                            <th>Browser</th>
                            <th>Platform(s)</th>
                            <th>Engine version</th>
                            <th>CSS grade</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>@endsection @section('external_js')
<script src="assets/lib/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/lib/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="assets/lib/datatables/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script src="assets/lib/datatables/plugins/buttons/js/dataTables.buttons.js" type="text/javascript"></script>
<script src="assets/lib/datatables/plugins/buttons/js/buttons.html5.js" type="text/javascript"></script>
<script src="assets/lib/datatables/plugins/buttons/js/buttons.flash.js" type="text/javascript"></script>
<script src="assets/lib/datatables/plugins/buttons/js/buttons.print.js" type="text/javascript"></script>
<script src="assets/lib/datatables/plugins/buttons/js/buttons.colVis.js" type="text/javascript"></script>
<script src="assets/lib/datatables/plugins/buttons/js/buttons.bootstrap.js" type="text/javascript"></script>
<script src="assets/js/app-tables-datatables.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        //initialize the javascript
        //   App.init();
        App.dataTables();
    });

</script>
@endsection
