
<?php $__env->startSection('title', 'Edit Slide'); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/dropzone.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Edit Slide</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">
    <a href="<?php echo e(route('admin.slides.index')); ?>">Slides</a>
</li>
<li class="breadcrumb-item">Edit Slide</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header p-3">Edit Slide</div>
                <div class="card-body p-3">
                     <?php if (isset($component)) { $__componentOriginal6396012a6cef5c19b3389606f3cd6f8d35a08cbb = $component; } ?>
<?php $component = $__env->getContainer()->make(BladeUIKit\Components\Forms\Form::class, ['method' => 'patch','action' => route('admin.slides.update', $slide),'hasFiles' => true]); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                        <div class="form-group">
                             <?php if (isset($component)) { $__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Label::class, ['for' => 'title']); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad)): ?>
<?php $component = $__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad; ?>
<?php unset($__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                             <?php if (isset($component)) { $__componentOriginalc956e18133c2dd5e943dac2fe8204fec03883341 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Inputs\Input::class, ['name' => 'title','value' => $slide->title]); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc956e18133c2dd5e943dac2fe8204fec03883341)): ?>
<?php $component = $__componentOriginalc956e18133c2dd5e943dac2fe8204fec03883341; ?>
<?php unset($__componentOriginalc956e18133c2dd5e943dac2fe8204fec03883341); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                             <?php if (isset($component)) { $__componentOriginalabbd4326acdd37e9a3da88375af5ebdfd7b875a0 = $component; } ?>
<?php $component = $__env->getContainer()->make(BladeUIKit\Components\Forms\Error::class, ['field' => 'title']); ?>
<?php $component->withName('error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalabbd4326acdd37e9a3da88375af5ebdfd7b875a0)): ?>
<?php $component = $__componentOriginalabbd4326acdd37e9a3da88375af5ebdfd7b875a0; ?>
<?php unset($__componentOriginalabbd4326acdd37e9a3da88375af5ebdfd7b875a0); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                        </div>
                        <div class="form-group">
                             <?php if (isset($component)) { $__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Label::class, ['for' => 'text']); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad)): ?>
<?php $component = $__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad; ?>
<?php unset($__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                             <?php if (isset($component)) { $__componentOriginal7a8e0359298380d706525ea53fb326f088cefb90 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Inputs\Textarea::class, ['name' => 'text']); ?>
<?php $component->withName('textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?><?php echo e($slide->text); ?> <?php if (isset($__componentOriginal7a8e0359298380d706525ea53fb326f088cefb90)): ?>
<?php $component = $__componentOriginal7a8e0359298380d706525ea53fb326f088cefb90; ?>
<?php unset($__componentOriginal7a8e0359298380d706525ea53fb326f088cefb90); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                             <?php if (isset($component)) { $__componentOriginalabbd4326acdd37e9a3da88375af5ebdfd7b875a0 = $component; } ?>
<?php $component = $__env->getContainer()->make(BladeUIKit\Components\Forms\Error::class, ['field' => 'title']); ?>
<?php $component->withName('error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalabbd4326acdd37e9a3da88375af5ebdfd7b875a0)): ?>
<?php $component = $__componentOriginalabbd4326acdd37e9a3da88375af5ebdfd7b875a0; ?>
<?php unset($__componentOriginalabbd4326acdd37e9a3da88375af5ebdfd7b875a0); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                        </div>
                        <div class="form-group">
                            <div class="checkbox checkbox-secondary">
                                 <?php if (isset($component)) { $__componentOriginal3a734479281d35b9dc7c343bc799be64eed913a8 = $component; } ?>
<?php $component = $__env->getContainer()->make(BladeUIKit\Components\Forms\Inputs\Checkbox::class, ['name' => 'is_active','checked' => $slide->is_active]); ?>
<?php $component->withName('checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['value' => '1']); ?>
<?php if (isset($__componentOriginal3a734479281d35b9dc7c343bc799be64eed913a8)): ?>
<?php $component = $__componentOriginal3a734479281d35b9dc7c343bc799be64eed913a8; ?>
<?php unset($__componentOriginal3a734479281d35b9dc7c343bc799be64eed913a8); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                                 <?php if (isset($component)) { $__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Label::class, ['for' => 'is_active']); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad)): ?>
<?php $component = $__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad; ?>
<?php unset($__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                     <?php if (isset($component)) { $__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Label::class, ['for' => 'btn_name']); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad)): ?>
<?php $component = $__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad; ?>
<?php unset($__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                                     <?php if (isset($component)) { $__componentOriginalc956e18133c2dd5e943dac2fe8204fec03883341 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Inputs\Input::class, ['name' => 'btn_name','value' => $slide->btn_name]); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc956e18133c2dd5e943dac2fe8204fec03883341)): ?>
<?php $component = $__componentOriginalc956e18133c2dd5e943dac2fe8204fec03883341; ?>
<?php unset($__componentOriginalc956e18133c2dd5e943dac2fe8204fec03883341); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                                </div>
                                </div>
                                    <div class="col-md-6">
                                <div class="form-group">
                                     <?php if (isset($component)) { $__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Label::class, ['for' => 'btn_href']); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>Button Link <?php if (isset($__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad)): ?>
<?php $component = $__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad; ?>
<?php unset($__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                                     <?php if (isset($component)) { $__componentOriginalc956e18133c2dd5e943dac2fe8204fec03883341 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Inputs\Input::class, ['name' => 'btn_href','value' => $slide->btn_href]); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc956e18133c2dd5e943dac2fe8204fec03883341)): ?>
<?php $component = $__componentOriginalc956e18133c2dd5e943dac2fe8204fec03883341; ?>
<?php unset($__componentOriginalc956e18133c2dd5e943dac2fe8204fec03883341); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary">Submit</button>
                        </div>
                     <?php if (isset($__componentOriginal6396012a6cef5c19b3389606f3cd6f8d35a08cbb)): ?>
<?php $component = $__componentOriginal6396012a6cef5c19b3389606f3cd6f8d35a08cbb; ?>
<?php unset($__componentOriginal6396012a6cef5c19b3389606f3cd6f8d35a08cbb); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
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

<?php echo $__env->make('layouts.light.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\XAMPP\htdocs\starter-kit\resources\views/admin/slides/edit.blade.php ENDPATH**/ ?>