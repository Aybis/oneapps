@extends('layouts.master')

@section('title')
Form Ticket
@endsection

@section('title_content')
Edit Ticket
@endsection

@section('external_css')
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/daterangepicker/css/daterangepicker.css')}}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/select2/css/select2.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/bootstrap-slider/css/bootstrap-slider.css')}}" />
<link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" type="text/css" />
@endsection


@section('content')

<div class="row animated fadeInDown">
    <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
            <div class="panel-heading panel-heading-divider">Form Edit
            </div>
            <div class="panel-body">
                <form method="post" class="animated fadeIn delay-1s" action="">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group xs-pt-10 {{ $errors->has('noticket') ? 'has-error': ''}}">
                                    <label>Nomor Ticket*</label>
                                    <input  type="text"
                                            placeholder="IN57015549"
                                            parsley-trigger="change"
                                            id="noticket"
                                            name="noticket"
                                            class="form-control parsley-error"
                                            value="{{$data->noticket}}"
                                            autofocus>
                                    @if ($errors->has('noticket'))
                                    <span class="invalid-feedback text-danger">{{$errors->first('noticket')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group xs-pt-10 {{ $errors->has('customer') ? 'has-error': ''}}">
                                    <label>Customer</label>
                                    <input  type="text"
                                            placeholder="C4700063"
                                            parsley-trigger="change"
                                            id="customer"
                                            name="customer"
                                            class="form-control parsley-error"
                                            value="{{ $data->customer }}">
                                    @if ($errors->has('customer'))
                                    <span class="invalid-feedback text-danger">{{$errors->first('customer')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group xs-pt-10 {{ $errors->has('layanan') ? 'has-error': ''}}">
                                    <label>Layanan</label>
                                    <select name="layanan" class="select2" id="layanan">
                                        @foreach ($layanan as $item)
                                        <option value="{{ $item->layanan }}"
                                            {{  ($data->layanan == $item->layanan) ? 'selected disabled' : ''}}>
                                            {{ $item->layanan }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('layanan'))
                                    <span class="invalid-feedback text-danger">{{$errors->first('layanan')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group xs-pt-10 {{ $errors->has('segment') ? 'has-error': ''}}">
                                    <label>Segment</label>
                                    <select name="segment"
                                            class="select2 form-control"
                                            id="segment">
                                        @foreach ($segment as $item)
                                        <option value="{{ $item->segment }}"
                                            {{  ($data->segment == $item->segment) ? 'selected disabled' : ''}}>
                                            {{ $item->segment }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('segment'))
                                    <span class="invalid-feedback text-danger">{{$errors->first('segment')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group xs-pt-10 {{ $errors->has('headline') ? 'has-error': ''}}">
                                    <label>Headline</label>
                                    <textarea   name="headline"
                                                id="headline"
                                                class="form-control"
                                                >{{ $data->headline}}</textarea>
                                    @if ($errors->has('headline'))
                                    <span class="invalid-feedback text-danger">{{$errors->first('headline')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group xs-pt-10 {{ $errors->has('description') ? 'has-error': ''}}">
                                    <label>Description*</label>
                                    <textarea   name="description"
                                                id="description"
                                                class="form-control"
                                                >{{ $data->description}}</textarea>
                                    @if ($errors->has('description'))
                                    <span class="invalid-feedback text-danger">{{$errors->first('description')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group xs-pt-10 {{ $errors->has('area') ? 'has-error': ''}}">
                                    <label>Area</label>
                                    <select name="area"
                                            class="select2"
                                            id="area"
                                            data-placeholder="Pilih Area">
                                        @foreach ($area as $item)
                                        <option value="{{ $item->area }}"
                                            {{  ($data->area == $item->area) ? 'selected disabled' : ''}}>{{ $item->area }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group xs-pt-10 {{ $errors->has('status') ? 'has-error': ''}}">
                                    <label>Status</label>
                                    <input  type="text"
                                            placeholder="CLOSED"
                                            parsley-trigger="change" id="status"
                                            name="status"
                                            class="form-control parsley-error"
                                            value="{{ $data->status}}">
                                    @if ($errors->has('status'))
                                    <span class="invalid-feedback text-danger">{{$errors->first('status')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group xs-pt-10 {{ $errors->has('statusdate') ? 'has-error': ''}}">
                                    <label>Status Date</label>
                                    <input  type="date"
                                            placeholder=""
                                            parsley-trigger="change"
                                            id="statusdate"
                                            name="statusdate"
                                            class="form-control datetime parsley-error"
                                            value="{{ $data->statusdate}}">
                                    @if ($errors->has('statusdate'))
                                    <span class="invalid-feedback text-danger">{{$errors->first('statusdate')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group xs-pt-10 {{ $errors->has('opentiket') ? 'has-error': ''}}">
                                    <label>Open Ticket</label>
                                    <input  type="text"
                                            placeholder=""
                                            parsley-trigger="change"
                                            id="opentiket"
                                            name="opentiket"
                                            class="form-control datetimepicker parsley-error"
                                        value="{{ $data->opentiket}}" readonly>
                                    @if ($errors->has('opentiket'))
                                    <span class="invalid-feedback text-danger">{{$errors->first('opentiket')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group xs-pt-10 {{ $errors->has('respondtiket') ? 'has-error': ''}}">
                                    <label>Respond Ticket</label>
                                    <input  type="text"
                                            parsley-trigger="change"
                                            id="respondtiket"
                                            name="respondtiket"
                                            class="form-control datetimepicker parsley-error"
                                            readonly
                                            value="{{ $data->respondtiket}}">
                                    @if ($errors->has('respondtiket'))
                                    <span class="invalid-feedback text-danger">{{$errors->first('respondtiket')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group xs-pt-10 {{ $errors->has('durasipending') ? 'has-error': ''}}">
                                    <label>Durasi Pending</label>
                                    <input  type="time"
                                            parsley-trigger="change"
                                            id="durasipending"
                                            name="durasipending"
                                            class="form-control timepicker parsley-error"
                                            value="{{ $data->durasipending}}">
                                    @if ($errors->has('durasipending'))
                                    <span
                                        class="invalid-feedback text-danger">{{$errors->first('durasipending')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group xs-pt-10 {{ $errors->has('resolvedtiket') ? 'has-error': ''}}">
                                    <label>Resolved Ticket</label>
                                    <input  type="text"
                                            parsley-trigger="change"
                                            id="resolvedtiket"
                                            name="resolvedtiket"
                                            class="form-control datetimepicker parsley-error"
                                            value="{{ $data->resolvedtiket}}"
                                            readonly>
                                    @if ($errors->has('resolvedtiket'))
                                    <span
                                        class="invalid-feedback text-danger">{{$errors->first('resolvedtiket')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group xs-pt-10 {{ $errors->has('closedtiket') ? 'has-error': ''}}">
                                    <label>Closed Ticket</label>
                                    <input  type="text"
                                            parsley-trigger="change"
                                            id="closedtiket"
                                            name="closedtiket"
                                            class="form-control datetimepicker parsley-error"
                                            value="{{ $data->closedtiket}}" readonly>
                                    @if ($errors->has('closedtiket'))
                                    <span class="invalid-feedback text-danger">{{$errors->first('closedtiket')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group xs-pt-10 {{ $errors->has('resolveddescription') ? 'has-error': ''}}">
                                    <label>Resolved Description</label>
                                    <textarea   name="resolveddescription"
                                                id="resolveddescription"
                                                class="form-control"
                                                >{{ $data->resolveddescription}}</textarea>
                                    @if ($errors->has('resolveddescription'))
                                    <span
                                        class="invalid-feedback text-danger">{{$errors->first('resolveddescription')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" id="submit" class="btn btn-space btn-primary btn-lg" style="width: 7em;">
                            Save
                        </button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('external_js')
<script src="{{ asset('assets/lib/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/jquery.nestable/jquery.nestable.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/moment.js/min/moment.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript">
</script>
<script src="{{ asset('assets/lib/daterangepicker/js/daterangepicker.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/select2/js/select2.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/bootstrap-slider/js/bootstrap-slider.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/js/app-form-elements.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $('#submit').on('click', function () {
        $('form').attr('action', '/noc/update/{{$data->id}}');
    });
    $(document).ready(function () {
        //initialize the javascript
        App.formElements();

    });

</script>
@endsection
