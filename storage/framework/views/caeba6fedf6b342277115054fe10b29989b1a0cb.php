<textarea
    name="<?php echo e($name); ?>"
    id="<?php echo e($id); ?>"
    rows="<?php echo e($rows); ?>"
    <?php echo e($attributes->merge([
        'class' => 'form-control '.($errors->has($key) ? 'is-invalid' : ''),
    ])); ?>

><?php echo e(old($key, $slot)); ?></textarea>
<?php /**PATH E:\XAMPP\htdocs\starter-kit\resources\views/vendor/blade-ui-kit/components/forms/inputs/textarea.blade.php ENDPATH**/ ?>