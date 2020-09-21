<?php $__env->startPush('styles'); ?>
<style>
    input[type="file"] {
        height: auto;
    }
</style>
<?php $__env->stopPush(); ?>

<div class="tab-pane active" id="item-general" role="tabpanel">
    <div class="row">
        <div class="col-sm-12">
            <h4><small class="border-bottom mb-1">General</small></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="desktop-logo" class="d-block">Desktop Logo (<?php echo e(config('services.logo.desktop.width', 260)); ?>x<?php echo e(config('services.logo.desktop.height', 54)); ?>)</label>
                <input type="file" name="logo[desktop]" id="desktop-logo" class="form-control mb-1 <?php if($logo->desktop ?? ''): ?> d-none <?php endif; ?>">
                <img src="<?php echo e(asset($logo->desktop ?? '') ?? ''); ?>" alt="desktop Logo" class="img-responsive d-block" width="<?php echo e(config('services.logo.desktop.width', 260)); ?>" height="<?php echo e(config('services.logo.desktop.height', 54)); ?>" style="<?php if (! ($logo->desktop ?? '')): ?> display:none; <?php endif; ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="mobile-logo" class="d-block">Mobile Logo (<?php echo e(config('services.logo.mobile.width', 192)); ?>x<?php echo e(config('services.logo.mobile.height', 40)); ?>)</label>
                <input type="file" name="logo[mobile]" id="mobile-logo" class="form-control mb-1 <?php if($logo->mobile ?? ''): ?> d-none <?php endif; ?>">
                <img src="<?php echo e(asset($logo->mobile ?? '') ?? ''); ?>" alt="mobile Logo" class="img-responsiv d-blocke" width="<?php echo e(config('services.logo.mobile.width', 192)); ?>" height="<?php echo e(config('services.logo.mobile.height', 40)); ?>" style="<?php if (! ($logo->mobile ?? '')): ?> display:none; <?php endif; ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="favicon-logo" class="d-block">Favicon (<?php echo e(config('services.logo.favicon.width', 56)); ?>x<?php echo e(config('services.logo.favicon.height', 56)); ?>)</label>
                <input type="file" name="logo[favicon]" id="favicon-logo" class="form-control mb-1 <?php if($logo->favicon ?? ''): ?> d-none <?php endif; ?>">
                <img src="<?php echo e(asset($logo->favicon ?? '') ?? ''); ?>" alt="Favicon" class="img-responsive d-block" width="<?php echo e(config('services.logo.favicon.width', 56)); ?>" height="<?php echo e(config('services.logo.favicon.height', 56)); ?>" style="<?php if (! ($logo->favicon ?? '')): ?> display:none; <?php endif; ?>">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</div><?php /**PATH E:\XAMPP\htdocs\starter-kit\resources\views/admin/settings/general.blade.php ENDPATH**/ ?>