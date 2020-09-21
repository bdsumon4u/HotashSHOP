<input
    name="<?php echo e($name); ?>"
    type="<?php echo e($type); ?>"
    id="<?php echo e($id); ?>"
    <?php if($value): ?>value="<?php echo e($value); ?>"<?php endif; ?>
    <?php echo e($attributes->merge([
        'class' => 'form-control '.($errors->has($key) ? 'is-invalid' : ''),
    ])); ?>

/>
<?php /**PATH E:\XAMPP\htdocs\starter-kit\resources\views/vendor/blade-ui-kit/components/forms/inputs/input.blade.php ENDPATH**/ ?>