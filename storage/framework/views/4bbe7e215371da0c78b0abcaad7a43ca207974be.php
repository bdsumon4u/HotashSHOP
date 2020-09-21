<li class="mobile-links__item" data-collapse-item>
    <div class="mobile-links__item-title">
        <a href="#" class="mobile-links__item-link">Categories</a>
        <button class="mobile-links__item-toggle" type="button" data-collapse-trigger>
            <svg class="mobile-links__item-arrow" width="12px" height="7px">
                <use xlink:href="<?php echo e(asset('strokya/images/sprite.svg#arrow-rounded-down-12x7')); ?>"></use>
            </svg>
        </button>
    </div>
    <div class="mobile-links__item-sub-links" data-collapse-content>
        <ul class="mobile-links mobile-links--level--1">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="mobile-links__item" data-collapse-item>
                <div class="mobile-links__item-title">
                    <a href="#" class="mobile-links__item-link"><?php echo e($category->name); ?></a>
                    <?php if($category->childrens->isNotEmpty()): ?>
                    <button class="mobile-links__item-toggle" type="button" data-collapse-trigger>
                        <svg class="mobile-links__item-arrow" width="12px" height="7px">
                            <use xlink:href="<?php echo e(asset('strokya/images/sprite.svg#arrow-rounded-down-12x7')); ?>"></use>
                        </svg>
                    </button>
                    <?php endif; ?>
                </div>
                <?php if($category->childrens->isNotEmpty()): ?>
                <div class="mobile-links__item-sub-links" data-collapse-content>
                    <ul class="mobile-links mobile-links--level--2">
                        <?php $__currentLoopData = $category->childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="mobile-links__item" data-collapse-item>
                            <div class="mobile-links__item-title">
                                <a href="#" class="mobile-links__item-link"><?php echo e($category->name); ?></a>
                            </div>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</li><?php /**PATH E:\XAMPP\htdocs\starter-kit\resources\views/partials/mobile-menu-categories.blade.php ENDPATH**/ ?>