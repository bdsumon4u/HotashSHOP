<div class="tab-pane" id="item-others" role="tabpanel">
    <div class="row">
        <div class="col-sm-12">
            <h4><small class="border-bottom mb-1">Others</small></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Related Products</label>
                <div class="row border py-2">
                    <div class="col-md-6">
                        <label for="related_products-rows">Rows</label>
                         <?php if (isset($component)) { $__componentOriginalc956e18133c2dd5e943dac2fe8204fec03883341 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Inputs\Input::class, ['name' => 'related_products[rows]','id' => 'related_products-rows','value' => $related_products->rows ?? 1]); ?>
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
<?php $component = $__env->getContainer()->make(BladeUIKit\Components\Forms\Error::class, ['field' => 'related_products.rows']); ?>
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
                    <div class="col-md-6">
                        <label for="related_products-cols">Cols (4 or 5)</label>
                         <?php if (isset($component)) { $__componentOriginalc956e18133c2dd5e943dac2fe8204fec03883341 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Inputs\Input::class, ['name' => 'related_products[cols]','id' => 'related_products-cols','value' => $related_products->cols ?? 1]); ?>
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
<?php $component = $__env->getContainer()->make(BladeUIKit\Components\Forms\Error::class, ['field' => 'related_products.cols']); ?>
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
</div><?php /**PATH E:\XAMPP\htdocs\starter-kit\resources\views/admin/settings/others.blade.php ENDPATH**/ ?>