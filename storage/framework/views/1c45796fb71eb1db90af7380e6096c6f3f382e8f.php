
<?php $__env->startSection('title', 'Create Home Section'); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .select2 {
        width: 100% !important;
    }
    .select2-selection.select2-selection--multiple {
        display: flex;
        align-items: center;
    }
    .select2-container .select2-selection--single {
        border-color: #ced4da !important;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Create Home Section</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Create Home Section</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-5 justify-content-center">
    <div class="col-md-8">
        <div class="card rounded-0 shadow-sm">
            <div class="card-header p-3">Add New <strong>Section</strong></div>
            <div class="card-body p-3">
                 <?php if (isset($component)) { $__componentOriginal6396012a6cef5c19b3389606f3cd6f8d35a08cbb = $component; } ?>
<?php $component = $__env->getContainer()->make(BladeUIKit\Components\Forms\Form::class, ['action' => route('admin.home-sections.store'),'method' => 'POST']); ?>
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
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Inputs\Input::class, ['name' => 'title']); ?>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                 <?php if (isset($component)) { $__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Label::class, ['for' => 'type']); ?>
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
                                <select selector name="type" id="type" class="form-control">
                                    <option value="carousel-grid">Carousel Grid</option>
                                </select>
                                 <?php if (isset($component)) { $__componentOriginalabbd4326acdd37e9a3da88375af5ebdfd7b875a0 = $component; } ?>
<?php $component = $__env->getContainer()->make(BladeUIKit\Components\Forms\Error::class, ['field' => 'type']); ?>
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                 <?php if (isset($component)) { $__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Label::class, ['for' => 'order']); ?>
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
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Inputs\Input::class, ['type' => 'number','name' => 'order']); ?>
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
<?php $component = $__env->getContainer()->make(BladeUIKit\Components\Forms\Error::class, ['field' => 'order']); ?>
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                 <?php if (isset($component)) { $__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Label::class, ['for' => 'categories']); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad)): ?>
<?php $component = $__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad; ?>
<?php unset($__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> <span class="text-danger">*</span>
                                 <?php if (isset($component)) { $__componentOriginal4f66722947691db01920253e9e2edd1fa3282e1d = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\CategoryDropdown::class, ['categories' => $categories,'name' => 'categories[]','placeholder' => 'Select Category','id' => 'categories','multiple' => 'true','selected' => old('categories')]); ?>
<?php $component->withName('category-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal4f66722947691db01920253e9e2edd1fa3282e1d)): ?>
<?php $component = $__componentOriginal4f66722947691db01920253e9e2edd1fa3282e1d; ?>
<?php unset($__componentOriginal4f66722947691db01920253e9e2edd1fa3282e1d); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                                 <?php if (isset($component)) { $__componentOriginalabbd4326acdd37e9a3da88375af5ebdfd7b875a0 = $component; } ?>
<?php $component = $__env->getContainer()->make(BladeUIKit\Components\Forms\Error::class, ['field' => 'categories']); ?>
<?php $component->withName('error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'd-block']); ?>
<?php if (isset($__componentOriginalabbd4326acdd37e9a3da88375af5ebdfd7b875a0)): ?>
<?php $component = $__componentOriginalabbd4326acdd37e9a3da88375af5ebdfd7b875a0; ?>
<?php unset($__componentOriginalabbd4326acdd37e9a3da88375af5ebdfd7b875a0); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                 <?php if (isset($component)) { $__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Label::class, ['for' => 'rows']); ?>
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
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Inputs\Input::class, ['type' => 'number','name' => 'data[rows]']); ?>
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
<?php $component = $__env->getContainer()->make(BladeUIKit\Components\Forms\Error::class, ['field' => 'data.rows']); ?>
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
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                 <?php if (isset($component)) { $__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Label::class, ['for' => 'cols']); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad)): ?>
<?php $component = $__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad; ?>
<?php unset($__componentOriginal373f58fa693eb1202c1acc8658ad45d6306ee2ad); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> <span>(4 or 5)</span>
                                 <?php if (isset($component)) { $__componentOriginalc956e18133c2dd5e943dac2fe8204fec03883341 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Inputs\Input::class, ['type' => 'number','name' => 'data[cols]']); ?>
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
<?php $component = $__env->getContainer()->make(BladeUIKit\Components\Forms\Error::class, ['field' => 'data.cols']); ?>
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
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">
                        Submit
                    </button>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function(){
        $('[selector]').select2({
            // tags: true,
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.light.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\XAMPP\htdocs\starter-kit\resources\views/admin/home-sections/create.blade.php ENDPATH**/ ?>