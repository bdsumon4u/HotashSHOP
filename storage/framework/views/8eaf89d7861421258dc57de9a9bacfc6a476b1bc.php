<?php $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li class="mobile-links__item" data-collapse-item>
    <div class="mobile-links__item-title">
        <a href="<?php echo e(url($item->href)); ?>" class="mobile-links__item-link"><?php echo e($item->name); ?></a>
    </div>
</li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH E:\XAMPP\htdocs\starter-kit\resources\views/partials/header/menu/mobile.blade.php ENDPATH**/ ?>