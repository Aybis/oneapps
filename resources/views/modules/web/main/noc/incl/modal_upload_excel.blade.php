<!-- Nifty Modal-->
<div id="form-upload" class="modal-container modal-effect-9">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" data-dismiss="modal" aria-hidden="true" class="close modal-close"><span
                    class="mdi mdi-close"></span></button>
            {{-- <h3 class="modal-title">Import File</h3> --}}
        </div>
        <div class="modal-body">
            <div class="text-center">
                <form action="{{ url('noc/import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Choose File <span>*xls only</span></label>
                        <input type="file" name="file" placeholder="Input File" class="form-control">
                    </div>
                    <button type="button" data-dismiss="modal" class="btn btn-default modal-close">Cancel</button>
                    <button type="submit" class="btn btn-primary ">Upload</button>
                </form>
            </div>

        </div>
    </div>
</div>
