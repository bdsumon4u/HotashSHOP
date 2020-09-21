
<?php $__env->startSection('title', 'Slides'); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/dropzone.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Slides</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Slides</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row justify-content-center mb-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header p-3">Upload Images</div>
                <div class="card-body p-3">
                     <?php if (isset($component)) { $__componentOriginal6396012a6cef5c19b3389606f3cd6f8d35a08cbb = $component; } ?>
<?php $component = $__env->getContainer()->make(BladeUIKit\Components\Forms\Form::class, ['method' => 'post','action' => route('admin.slides.store'),'hasFiles' => true]); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'slides-dropzone','class' => 'dropzone']); ?>
                        <div class="dz-message needsclick">
                            <i class="icon-cloud-up"></i>
                            <h6>Drop files here or click to upload.</h6>
                            <span class="note needsclick">(Recommended <strong>840x395</strong> dimension.)</span>
                        </div>
                     <?php if (isset($__componentOriginal6396012a6cef5c19b3389606f3cd6f8d35a08cbb)): ?>
<?php $component = $__componentOriginal6396012a6cef5c19b3389606f3cd6f8d35a08cbb; ?>
<?php unset($__componentOriginal6396012a6cef5c19b3389606f3cd6f8d35a08cbb); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                </div>
            </div>
            <div class="card mb-5">
                <div class="card-header p-3">Current Slides</div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td width="10"><?php echo e($slide->id); ?></td>
                                    <td width="200">
                                        <img src="<?php echo e(asset($slide->mobile_src)); ?>" width="200" height="100" alt="">
                                    </td>
                                    <td><?php echo e($slide->title); ?></td>
                                    <td width="10">
                                        <?php if($slide->is_active): ?>
                                        <span class="badge badge-success">Active</span>
                                        <?php else: ?>
                                        <span class="badge badge-danger">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td width="80">
                                         <?php if (isset($component)) { $__componentOriginal6396012a6cef5c19b3389606f3cd6f8d35a08cbb = $component; } ?>
<?php $component = $__env->getContainer()->make(BladeUIKit\Components\Forms\Form::class, ['method' => 'delete','action' => route('admin.slides.destroy', $slide)]); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a class="btn btn-primary" href="<?php echo e(route('admin.slides.edit', $slide)); ?>">Edit</a>
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </div>
                                         <?php if (isset($__componentOriginal6396012a6cef5c19b3389606f3cd6f8d35a08cbb)): ?>
<?php $component = $__componentOriginal6396012a6cef5c19b3389606f3cd6f8d35a08cbb; ?>
<?php unset($__componentOriginal6396012a6cef5c19b3389606f3cd6f8d35a08cbb); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('assets/js/dropzone/dropzone.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/dropzone/dropzone-script.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    Dropzone.options.slidesDropzone = {
        init: function () {
            this.on('complete', function(){
                if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                    $('.datatable').DataTable().ajax.reload();
                }
            })
        }
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.light.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\XAMPP\htdocs\starter-kit\resources\views/admin/slides/index.blade.php ENDPATH**/ ?>