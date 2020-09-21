<?php $__errorArgs = [$field, $bag];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div <?php echo e($attributes->merge(['class' => 'invalid-feedback'])); ?>>
        <?php if($slot->isEmpty()): ?>
            <?php echo e($message); ?>

        <?php else: ?>
            <?php echo e($slot); ?>

        <?php endif; ?>
    </div>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
<?php /**PATH E:\XAMPP\htdocs\starter-kit\resources\views/vendor/blade-ui-kit/components/forms/error.blade.php ENDPATH**/ ?>