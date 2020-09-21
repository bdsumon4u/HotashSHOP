<div class="tab-pane" id="item-2" role="tabpanel">
    <div class="row">
        <div class="col-sm-12">
            <h4><small class="border-bottom mb-1">Social</small></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-facebook"></i></span>
                </div>
                 <?php if (isset($component)) { $__componentOriginalc956e18133c2dd5e943dac2fe8204fec03883341 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Inputs\Input::class, ['name' => 'social[facebook][link]','value' => $social->facebook->link ?? '']); ?>
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
                <div class="input-group-append">
                    <span class="input-group-text">
                        <input type="checkbox" name="social[facebook][display]" <?php echo e(old('social.facebook.display', $social->facebook->display ?? false) ? 'checked' : ''); ?>>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-twitter"></i></span>
                </div>
                 <?php if (isset($component)) { $__componentOriginalc956e18133c2dd5e943dac2fe8204fec03883341 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Inputs\Input::class, ['name' => 'social[twitter][link]','value' => $social->twitter->link ?? '']); ?>
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
                <div class="input-group-append">
                    <span class="input-group-text">
                        <input type="checkbox" name="social[twitter][display]" <?php echo e(old('social.twitter.display', $social->twitter->display ?? false) ? 'checked' : ''); ?>>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-instagram"></i></span>
                </div>
                 <?php if (isset($component)) { $__componentOriginalc956e18133c2dd5e943dac2fe8204fec03883341 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Inputs\Input::class, ['name' => 'social[instagram][link]','value' => $social->instagram->link ?? '']); ?>
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
                <div class="input-group-append">
                    <span class="input-group-text">
                        <input type="checkbox" name="social[instagram][display]" <?php echo e(old('social.instagram.display', $social->instagram->display ?? false) ? 'checked' : ''); ?>>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-youtube"></i></span>
                </div>
                 <?php if (isset($component)) { $__componentOriginalc956e18133c2dd5e943dac2fe8204fec03883341 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Inputs\Input::class, ['name' => 'social[youtube][link]','value' => $social->youtube->link ?? '']); ?>
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
                <div class="input-group-append">
                    <span class="input-group-text">
                        <input type="checkbox" name="social[youtube][display]" <?php echo e(old('social.youtube.display', $social->youtube->display ?? false) ? 'checked' : ''); ?>>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</div><?php /**PATH E:\XAMPP\htdocs\starter-kit\resources\views/admin/settings/social.blade.php ENDPATH**/ ?>