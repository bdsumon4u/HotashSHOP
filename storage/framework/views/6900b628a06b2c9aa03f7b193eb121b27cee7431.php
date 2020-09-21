<select selector name="<?php echo e($name); ?>" placeholder="<?php echo e($placeholder ?? ''); ?>" data-placeholder="<?php echo e($placeholder ?? ''); ?>" id="<?php echo e($id ?? ''); ?>" class="form-control" <?php echo e(($multiple ?? false) == 'true' ? 'multiple' : ''); ?>>
    <?php if(($multiple ?? false) != 'true'): ?>    
    <option value=""><?php echo e($placeholder); ?></option>
    <?php endif; ?>
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($category->id); ?>" <?php if(is_array($selected)): ?> <?php echo e(in_array($category->id, $selected) ? 'selected' : ''); ?> <?php else: ?> <?php echo e($selected == $category->id ? 'selected' : ''); ?> <?php endif; ?> <?php if($disabled == $category->id): ?> disabled <?php endif; ?>><?php echo e($category->name); ?></option>
        <?php echo $__env->renderWhen(isset($category->childrens), 'components.categories.childrens', ['childrens' => $category->childrens, 'depth' => 1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select><?php /**PATH E:\XAMPP\htdocs\starter-kit\resources\views/components/categories/dropdown.blade.php ENDPATH**/ ?>