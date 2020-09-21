<div class="nav-panel__departments">
    <!-- .departments -->
    <div
        class="departments <?php echo e(request()->is('/') ? 'departments--opened departments--fixed' : ''); ?>"
        data-departments-fixed-by="<?php echo e(request()->is('/') ? '.block-slideshow' : ''); ?>">
        <div class="departments__body">
            <div class="departments__links-wrapper">
                <ul class="departments__links">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="departments__item <?php if($category->childrens->isNotEmpty()): ?> departments__item--menu <?php endif; ?>">
                        <a href="<?php echo e(route('categories.products', $category)); ?>"><?php echo e($category->name); ?>

                            <?php if($category->childrens->isNotEmpty()): ?>
                            <svg class="departments__link-arrow" width="6px" height="9px">
                                <use
                                    xlink:href="<?php echo e(asset('strokya/images/sprite.svg#arrow-rounded-right-6x9')); ?>">
                                </use>
                            </svg>
                            <?php endif; ?>
                        </a>
                        <?php if($category->childrens->isNotEmpty()): ?>
                        <div class="departments__menu">
                            <!-- .menu -->
                            <ul class="menu menu--layout--classic">
                                <?php $__currentLoopData = $category->childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(route('categories.products', $category)); ?>"><?php echo e($category->name); ?>

                                        <?php if($category->childrens->isNotEmpty()): ?>
                                        <svg class="menu__arrow" width="6px" height="9px">
                                            <use
                                                xlink:href="http://127.0.0.1:8000/strokya/images/sprite.svg#arrow-rounded-right-6x9">
                                            </use>
                                        </svg>
                                        <?php endif; ?>
                                    </a>
                                    <?php if($category->childrens->isNotEmpty()): ?>
                                    <div class="menu__submenu">
                                        <!-- .menu -->
                                        <ul class="menu menu--layout--classic">
                                            <?php $__currentLoopData = $category->childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><a href="<?php echo e(route('categories.products', $category)); ?>"><?php echo e($category->name); ?></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                        <!-- .menu / end -->
                                    </div>
                                    <?php endif; ?>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul><!-- .menu / end -->
                        </div>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
        <button class="departments__button">
            <svg class="departments__button-icon" width="18px" height="14px">
                <use
                    xlink:href="<?php echo e(asset('strokya/images/sprite.svg#menu-18x14')); ?>">
                </use>
            </svg>
            Shop By Category
            <svg class="departments__button-arrow" width="9px" height="6px">
                <use
                    xlink:href="<?php echo e(asset('strokya/images/sprite.svg#arrow-rounded-down-9x6')); ?>">
                </use>
            </svg>
        </button>
    </div><!-- .departments / end -->
</div><?php /**PATH E:\XAMPP\htdocs\starter-kit\resources\views/partials/departments.blade.php ENDPATH**/ ?>