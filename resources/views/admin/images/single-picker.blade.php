@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/dropzone.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
@endpush


<!-- The Modal -->
<div class="modal" id="single-picker">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header p-3">
                <h4 class="modal-title">Image Picker</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body p-3">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card rounded-0">
                            <div class="card-body">
                                <x-form method="post" :action="route('admin.images.store')" id="image-dropzone-single" class="dropzone" has-files>
                                    <div class="dz-message needsclick">
                                        <i class="icon-cloud-up"></i>
                                        <h6>Drop files here or click to upload.</h6>
                                        <span class="note needsclick">(Recommended <strong>700x700</strong> dimension.)</span>
                                    </div>
                                </x-form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover single-picker w-100" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th width="150">Preview</th>
                                        <th>Filename</th>
                                        <th>Mime</th>
                                        <th>Size</th>
                                        <th width="10">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer p-3">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('js')
<script src="{{asset('assets/js/dropzone/dropzone.js')}}"></script>
<script src="{{asset('assets/js/dropzone/dropzone-script.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
@endpush

@push('scripts')
<script>
    var tableSingle = $('.single-picker').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{!! route('api.images.single') !!}",
        columns: [
            { data: 'id' },
            { data: 'preview' },
            { data: 'filename', name: 'filename' },
            { data: 'mime', name: 'mime' },
            { data: 'size_human', name: 'size' },
            { data: 'action' },
        ],
        order: [
            [0, 'desc']
        ],
    });

    tableSingle.on('draw', function () {
        $('#single-select-{{ $selected ?? 0 }}').prop('checked', true);
    });

    $('#single-picker').on('click', '.select-image', function (ev) {
        $('.base_image-preview').html('<img src="'+$(this).data('src')+'" alt="Base Image" data-toggle="modal" data-target="#single-picker" id="base_image-preview" class="img-thumbnail img-responsive" style="height: 150px; width: 150px; margin: 5px; margin-left: 0;"><input type="hidden" name="base_image" value="'+$(this).data('id')+'"><input type="hidden" name="base_image_src" value="'+$(this).data('src')+'">').removeClass('d-none');
        $(this).parents('.modal').modal('hide');
        $.notify('<i class="fa fa-bell-o mr-1"></i> Base image selected', {
            type: 'success',
            allow_dismiss: true,
            // delay: 2000,
            showProgressbar: true,
            timer: 300,
            z_index: 9999,
            animate:{
                enter:'animated fadeInDown',
                exit:'animated fadeOutUp'
            }
        });
    });

    Dropzone.options.imageDropzoneSingle = {
        init: function () {
            this.on('complete', function(){
                if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                    console.log('yes');
                    tableSingle.ajax.reload();
                }
            });
        }
    };
</script>
@endpush