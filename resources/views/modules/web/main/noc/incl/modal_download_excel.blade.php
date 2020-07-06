<!-- Nifty Modal-->
<div id="form-download" class="modal-container modal-effect-9">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" data-dismiss="modal" aria-hidden="true" class="close modal-close"><span
                    class="mdi mdi-close"></span></button>
            {{-- <h3 class="modal-title">Import File</h3> --}}
        </div>
        <div class="modal-body">
            <div class="text-center">
                <form action="{{ url('noc/export') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div style="text-align:-webkit-center">
                        <select name="bulan" id="bulan" class="bulan form-group" style="width:20%;height:34px">
                        </select>
                        <select name="tahun" id="tahun" class="tahun form-group" style="width:20%;height:34px">
                        </select>

                    </div>
                    <div class="text-center">
                            <select name="customer" id="" class="select2 select2-sm" style="width:100%;height:34px">
                                <option value="all">Select Customer</option>
                                @foreach ($customer as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="mt-8" style="margin-top: 4%">
                        <button class="btn btn-secondary btn-space modal-close" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary btn-space modal-close" type="submit">Download</button>
                      </div>
                </form>
            </div>
        </div>
    </div>
</div>
