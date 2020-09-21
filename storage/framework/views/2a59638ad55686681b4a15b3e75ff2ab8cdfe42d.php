<div class="tab-pane" id="item-1" role="tabpanel">
    <div class="row">
        <div class="col-sm-12">
            <h4><small class="border-bottom mb-1">Company</small></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="company-name">Company Name</label>
                 <?php if (isset($component)) { $__componentOriginalc956e18133c2dd5e943dac2fe8204fec03883341 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Inputs\Input::class, ['name' => 'company[name]','id' => 'company-name','value' => $company->name ?? '']); ?>
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
<?php $component = $__env->getContainer()->make(BladeUIKit\Components\Forms\Error::class, ['field' => 'company.name']); ?>
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
                <label for="company-email">Company Email</label>
                 <?php if (isset($component)) { $__componentOriginalc956e18133c2dd5e943dac2fe8204fec03883341 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Inputs\Input::class, ['name' => 'company[email]','id' => 'company-email','value' => $company->email ?? '']); ?>
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
<?php $component = $__env->getContainer()->make(BladeUIKit\Components\Forms\Error::class, ['field' => 'company.email']); ?>
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
        <div class="col">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="company-phone">Company Phone</label>
                         <?php if (isset($component)) { $__componentOriginalc956e18133c2dd5e943dac2fe8204fec03883341 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Inputs\Input::class, ['name' => 'company[phone]','id' => 'company-phone','value' => $company->phone ?? '']); ?>
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
<?php $component = $__env->getContainer()->make(BladeUIKit\Components\Forms\Error::class, ['field' => 'company.phone']); ?>
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
                        <label for="company-tagline">Company Tagline</label>
                         <?php if (isset($component)) { $__componentOriginalc956e18133c2dd5e943dac2fe8204fec03883341 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Inputs\Input::class, ['name' => 'company[tagline]','id' => 'company-tagline','value' => $company->tagline ?? '']); ?>
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
<?php $component = $__env->getContainer()->make(BladeUIKit\Components\Forms\Error::class, ['field' => 'company.tagline']); ?>
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
                        <label for="company-address">Company Address</label>
                         <?php if (isset($component)) { $__componentOriginal7a8e0359298380d706525ea53fb326f088cefb90 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Inputs\Textarea::class, ['name' => 'company[address]','id' => 'company-address','rows' => '4']); ?>
<?php $component->withName('textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?><?php echo e($company->address ?? ''); ?> <?php if (isset($__componentOriginal7a8e0359298380d706525ea53fb326f088cefb90)): ?>
<?php $component = $__componentOriginal7a8e0359298380d706525ea53fb326f088cefb90; ?>
<?php unset($__componentOriginal7a8e0359298380d706525ea53fb326f088cefb90); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                         <?php if (isset($component)) { $__componentOriginalabbd4326acdd37e9a3da88375af5ebdfd7b875a0 = $component; } ?>
<?php $component = $__env->getContainer()->make(BladeUIKit\Components\Forms\Error::class, ['field' => 'company.address']); ?>
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
        </div>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</div><?php /**PATH E:\XAMPP\htdocs\starter-kit\resources\views/admin/settings/company.blade.php ENDPATH**/ ?>