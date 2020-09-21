<form method="<?php echo e($method !== 'GET' ? 'POST' : 'GET'); ?>" action="<?php echo e($action); ?>" <?php echo $hasFiles ? 'enctype="multipart/form-data"' : ''; ?> <?php echo e($attributes); ?>>
    <?php echo csrf_field(); ?>
    <?php echo method_field($method); ?>

    <?php echo e($slot); ?>

</form>
<?php /**PATH E:\XAMPP\htdocs\starter-kit\vendor\blade-ui-kit\blade-ui-kit\src/../resources/views/components/forms/form.blade.php ENDPATH**/ ?>