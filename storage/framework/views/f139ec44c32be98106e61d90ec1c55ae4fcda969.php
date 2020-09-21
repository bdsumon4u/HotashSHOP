<div class="block block-products-carousel mb-0" data-layout="grid-<?php echo e($cols ?? 5); ?>">
    <div class="container">
        <div class="block-header">
            <h3 class="block-header__title"><?php echo e($title); ?></h3>
            <div class="block-header__divider"></div>
            <div class="block-header__arrows-list">
                <button class="block-header__arrow block-header__arrow--left" type="button">
                    <svg width="7px" height="11px">
                        <use xlink:href="<?php echo e(asset('strokya/images/sprite.svg#arrow-rounded-left-7x11')); ?>"></use>
                    </svg>
                </button>
                <button class="block-header__arrow block-header__arrow--right" type="button">
                    <svg width="7px" height="11px">
                        <use xlink:href="<?php echo e(asset('strokya/images/sprite.svg#arrow-rounded-right-7x11')); ?>"></use>
                    </svg>
                </button>
            </div>
        </div>
        <div class="block-products-carousel__slider">
            <div class="block-products-carousel__preloader"></div>
            <div class="owl-carousel">
                <?php $__currentLoopData = $products->chunk($rows ?? 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="block-products-carousel__column">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="block-products-carousel__cell">
                        <div class="product-card" data-id="<?php echo e($product->id); ?>" data-max="<?php echo e($product->should_track ? $product->stock_count : -1); ?>">
                            <div class="product-card__image">
                                <a href="<?php echo e(route('products.show', $product)); ?>">
                                    <img src="<?php echo e(asset($product->base_image->src)); ?>" alt="">
                                </a>
                            </div>
                            <div class="product-card__info">
                                <div class="product-card__name">
                                    <a href="<?php echo e(route('products.show', $product)); ?>"><?php echo e($product->name); ?></a>
                                </div>
                            </div>
                            <div class="product-card__actions">
                                <div class="product-card__availability">Availability:
                                    <?php if(! $product->should_track): ?>
                                    <span class="text-success">In Stock</span>
                                    <?php else: ?>
                                    <span class="text-<?php echo e($product->stock_count ? 'success' : 'danger'); ?>"><?php echo e($product->stock_count); ?> In Stock</span>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="product-card__prices <?php echo e($product->selling_price == $product->price ? '' : 'has-special'); ?>">
                                    <?php if($product->selling_price == $product->price): ?>
                                    $ <span><?php echo e($product->price); ?></span>
                                    <?php else: ?>
                                    <span class="product-card__new-price">$ <span><?php echo e($product->selling_price); ?></span></span>
                                    <span class="product-card__old-price">$ <span><?php echo e($product->price); ?></span></span>
                                    <?php endif; ?>
                                </div>
                                <div class="product-card__buttons">
                                    <button class="btn btn-primary product-card__addtocart" type="button">Add To Cart</button>
                                    <button class="btn btn-primary product-card__ordernow" type="button">Order Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div><?php /**PATH E:\XAMPP\htdocs\starter-kit\resources\views/partials/products-carousel/grid.blade.php ENDPATH**/ ?>