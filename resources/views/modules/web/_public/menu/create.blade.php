@extends('layouts.master')

@section('title')
Form Menu
@endsection

@section('title_content')
Create Menu
@endsection

@section('external_css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/daterangepicker/css/daterangepicker.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/select2/css/select2.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/bootstrap-slider/css/bootstrap-slider.css')}}"/>
<link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" type="text/css"/>
@endsection

@section('content')
<div class="row animated fadeInDown">
    <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
            <div class="panel-heading panel-heading-divider">Form Create Menu
            </div>
            <div class="panel-body">
                <form method="post" class="animated fadeIn delay-1s" class="" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="container" style="width:50%">
                            <div class="row">
                                <div class="form-group col-sm-12 {{ $errors->has('menu_name') ? 'has-error': ''}}">
                                    <label>Menu Name</label>
                                    <input type="text" name="menu_name" placeholder="Enter Menu Name" class="form-control" value="{{ old('menu_name')}}">
                                    @if ($errors->has('menu_name'))
                                    <span class="invalid-feedback text-danger">{{$errors->first('menu_name')}}</span>
                                    @endif
                                </div>
                                <div class="form-group col-sm-12 {{ $errors->has('menu_display') ? 'has-error': ''}}">
                                    <label>Menu Display</label>
                                    <input type="text" name="menu_display" placeholder="Enter Menu Display" class="form-control" value="{{ old('menu_display')}}">
                                    @if ($errors->has('menu_display'))
                                    <span class="invalid-feedback text-danger">{{$errors->first('menu_display')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="container" style="width:50%">
                            <button type="submit" id="submit" class="btn btn-space btn-primary btn-lg"
                            onclick="validate_activity();" style="width: 7em;">Save</button>
                        </div>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('external_js')
{{-- <script src="{{ asset('assets/lib/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/jquery.nestable/jquery.nestable.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/moment.js/min/moment.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/daterangepicker/js/daterangepicker.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/select2/js/select2.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/bootstrap-slider/js/bootstrap-slider.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/js/app-form-elements.js')}}" type="text/javascript"></script> --}}
<script type="text/javascript">
    $('#submit').on('click', function () {
        $('form').attr('action', '/menu/store');
    });

</script>
@endsection
