<div class="site-header__topbar topbar">
    <div class="topbar__container container">
        <div class="topbar__row">
            <?php $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="topbar__item topbar__item--link">
                <a class="topbar-link" href="<?php echo e(url($item->href)); ?>"><?php echo e($item->name); ?></a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="topbar__spring"></div>
            <div class="topbar__item topbar__item--link">
                <a class="topbar-link" href="<?php echo e(url('/track-order')); ?>">Track Order</a>
            </div>
        </div>
    </div>
</div><?php /**PATH E:\XAMPP\htdocs\starter-kit\resources\views/partials/topbar.blade.php ENDPATH**/ ?>