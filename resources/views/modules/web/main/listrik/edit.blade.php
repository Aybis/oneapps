@extends('layouts.master')

@section('title')
Form Listrik
@endsection

@section('title_content')
Edit Listrik
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
                {{-- <span class="panel-subtitle">This is the default bootstrap form layout</span> --}}
            </div>
            <div class="panel-body">
                <form method="post" class="animated fadeIn delay-1s" data-parsley-validate=""
                    novalidate=" action="" enctype=" multipart/form-data"> @csrf <input type="hidden" name="id_listrik"
                    value="{{ $listrik->id}}">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group xs-pt-10 {{ $errors->has('id_pelanggan') ? 'has-error': ''}}">
                                    <label>ID Pelanggan*</label>
                                    <input type="text" placeholder="ID123XXX" parsley-trigger="change" id="id_pelanggan"
                                        name="id_pelanggan" class="form-control parsley-error"
                                        value="{{ $listrik->id_pelanggan}}">
                                    @if ($errors->has('id_pelanggan'))
                                    <span class="invalid-feedback text-danger">{{$errors->first('id_pelanggan')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group xs-pt-10">
                                    <label>No. Meter</label>
                                    <input type="text" id="no_meter" name="no_meter" class="form-control"
                                        value="{{ $listrik->no_meter}}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group xs-pt-10">
                                    <label>Nama Pelanggan</label>
                                    <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-control"
                                        value="{{ $listrik->nama_pelanggan}}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group xs-pt-10">
                                    <label for="">Alamat</label>
                                    <textarea name="alamat_pelanggan" id="alamat_pelanggan"
                                        class="form-control">{{ $listrik->alamat_pelanggan}}"</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group xs-pt-10">
                                    <label>Tarif</label>
                                    <input type="text" placeholder="Tarif" id="tarif" name="tarif" class="form-control"
                                        value="{{ $listrik->tarif}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group xs-pt-10">
                                    <label>Daya</label>
                                    <input type="text" placeholder="Daya" id="daya" name="daya" class="form-control"
                                        value="{{ $listrik->daya}}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group xs-pt-10">
                                    <label>Witel</label>
                                    <select name="witel" class="select2" id="witel" data-placeholder="Pilih Witel">
                                        @foreach ($witel as $item)
                                        <option value="{{ $item->witel }}"
                                            {{  ($listrik->witel == $item->witel) ? 'selected' : ''}}>{{ $item->witel }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group xs-pt-10">
                                    <label>Kota</label>
                                    <select name="kota" class="select2" id="kota" data-placeholder="Pilih Kota">
                                        @foreach ($kota as $item)
                                        <option value="{{ $item->kota }}"
                                            {{  ($listrik->kota == $item->kota) ? 'selected' : ''}}>{{ $item->kota }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group xs-pt-10">
                                    <label>Provinsi</label>
                                    <select name="provinsi" class="select2" id="provinsi"
                                        data-placeholder="Pilih Provinsi">
                                        @foreach ($provinsi as $item)
                                        <option value="{{ $item->provinsi }}"
                                            {{  ($listrik->provinsi == $item->provinsi) ? 'selected' : ''}}>
                                            {{ $item->provinsi }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group xs-pt-10">
                                    <label>Area PINS</label>
                                    <select name="area_pins" id="area_pins" class="select2"
                                        data-placeholder="Pilih Area PINS">
                                        @foreach ($area as $item)
                                        <option value="{{ $item->area_pins }}"
                                            {{  ($listrik->area_pins == $item->area_pins) ? 'selected' : ''}}>
                                            {{ $item->area_pins }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group xs-pt-10">
                                    <label>DIVRE</label>
                                    <select name="divre" class="select2" id="divre" data-placeholder="Pilih DivRe">
                                        <option value="" disabled selected>Pilih DivRe</option>
                                        @foreach ($divre as $item)
                                        <option value="{{ $item->divre }}"
                                            {{  ($listrik->divre == $item->divre) ? 'selected' : ''}}>
                                            {{ $item->divre }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group xs-pt-10">
                                    <label>Unit UP</label>
                                    <select name="unitup" class="select2" id="unitup" data-placeholder="Pilih Unit Up">
                                        <option value="" disabled selected>Pilih Unit Up</option>
                                        @foreach ($unitup as $item)
                                        <option value="{{ $item->unitup }}"
                                            {{  ($listrik->unitup== $item->unitup) ? 'selected' : ''}}>
                                            {{ $item->unitup }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group xs-pt-10">
                                    <label>Tipe</label>
                                    <select name="tipe" class="select2" id="tipe" data-placeholder="Pilih Tipe">
                                        <option value="" disabled selected>Pilih Tipe</option>
                                        @foreach ($tipe as $item)
                                        <option value="{{ $item->tipe }}"
                                            {{  ($listrik->tipe == $item->tipe) ? 'selected' : ''}}>{{ $item->tipe }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group xs-pt-10">
                                    <label>Alamat Unit UP</label>
                                    <textarea name="alamat_unitup" id="alamat_unitup"
                                        class="form-control">{{$listrik->alamat_unitup}}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group xs-pt-10">
                                    <label>Status</label>
                                    <input type="text" id="status" name="status" placeholder="Status"
                                        class="form-control" value="{{ $listrik->status}}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group xs-pt-10">
                                    <label>NDE</label>
                                    <input type="text" id="nde" name="nde" placeholder="NDE" class="form-control"
                                        value="{{ $listrik->nde}}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group xs-pt-10">
                                    <label>STO</label>
                                    <input type="text" id="sto" name="sto" placeholder="STO" class="form-control"
                                        value="{{ $listrik->sto}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group xs-pt-10">
                                    <label>Nama MDU</label>
                                    <input type="text" id="nama_mdu" name="nama_mdu" placeholder="Nama MDU"
                                        class="form-control" value="{{ $listrik->nama_mdu}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group xs-pt-10">
                                    <label>Koordinat</label>
                                    <input type="text" id="koordinat" name="koordinat" placeholder="Koordinat"
                                        class="form-control" value="{{ $listrik->koordinat}}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group xs-pt-10">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" id="keterangan"
                                        class="form-control">{{ $listrik->keterangan}}"</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" id="submit" class="btn btn-space btn-primary btn-lg"
                            onclick="validate_activity();" style="width: 7em;">Save</button>
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
        $('form').attr('action', '/listrik/store');
    });
    $(document).ready(function () {
        //initialize the javascript
        // App.init();
        App.formElements();
    });

</script>
@endsection
