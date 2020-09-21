<div class="block-slideshow block-slideshow--layout--with-departments block">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-9 offset-lg-3">
                <div class="block-slideshow__body">
                    <div class="owl-carousel">
                        <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="block-slideshow__slide" href="#">
                            <div class="block-slideshow__slide-image block-slideshow__slide-image--desktop"
                                style="background-image: url(<?php echo e(asset($slide->desktop_src)); ?>); background-position: center;"></div>
                            <div class="block-slideshow__slide-image block-slideshow__slide-image--mobile"
                                style="background-image: url(<?php echo e(asset($slide->mobile_src)); ?>); background-position: center;"></div>
                            <div class="block-slideshow__slide-content">
                                <div class="block-slideshow__slide-title"><?php echo $slide->title; ?></div>
                                <div class="block-slideshow__slide-text"><?php echo $slide->text; ?></div>
                                <?php if($slide->btn_href && $slide->btn_name): ?>
                                <div class="block-slideshow__slide-button">
                                    <a href="<?php echo e($slide->btn_href); ?>" class="btn btn-primary btn-lg"><?php echo e($slide->btn_name); ?></a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH E:\XAMPP\htdocs\starter-kit\resources\views/partials/slides.blade.php ENDPATH**/ ?>