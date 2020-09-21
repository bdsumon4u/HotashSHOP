<div class="nav-panel__nav-links nav-links">
    <ul class="nav-links__list">
        <?php $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="nav-links__item nav-links__item--with-submenu">
            <a href="<?php echo e(url($item->href)); ?>">
                <span><?php echo e($item->name); ?></span>
            </a>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div><?php /**PATH E:\XAMPP\htdocs\starter-kit\resources\views/partials/header/menu/desktop.blade.php ENDPATH**/ ?>