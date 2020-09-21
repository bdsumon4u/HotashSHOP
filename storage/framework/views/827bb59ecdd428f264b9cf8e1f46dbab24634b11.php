
<?php $__env->startSection('title', 'Settings'); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/animate.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .nav-tabs {
        border: 2px solid #ddd;
    }
    .nav-tabs li:hover a,
    .nav-tabs li a.active {
        border-radius: 0;
        border-bottom-color: #ddd !important;
    }
    .nav-tabs li a.active {
        background-color: #f0f0f0 !important;
    }
    .nav-tabs li a:hover {
        border-bottom: 1px solid #ddd;
        background-color: #f7f7f7;
    }

    .is-invalid + .SumoSelect + .invalid-feedback {
        display: block;
    }


    .input-group {
        display: flex;
        justify-content: center;
        margin-bottom: 1rem;
        border: 1px solid #ddd;
        padding: 5px;
        box-sizing: content-box;
    }
    .input-group * {
        border-radius: 0;
    }
    .input-group-append {
        cursor: pointer;
    }
    .input-group input, .input-group select {
        min-width: 250px !important;
        max-width: 450px !important;
    }
    .select2 {
        width: 100% !important;
    }
    .input-group-append input {
        min-width: 0 !important;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Settings</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Settings</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card rounded-0 shadow-sm">
            <div class="card-header p-3">Admin <strong>Settings</strong></div>
            <div class="card-body p-3">
                <div class="row justify-content-center">
                    <div class="col-sm-6 col-md-4 col-xl-3">
                        <ul class="nav nav-tabs list-group" role="tablist">
                            <li class="nav-item rounded-0"><a class="nav-link active" data-toggle="tab" href="#item-general">General</a></li>
                            <li class="nav-item rounded-0"><a class="nav-link" data-toggle="tab" href="#item-1">Company</a></li>
                            <li class="nav-item rounded-0"><a class="nav-link" data-toggle="tab" href="#item-2">Social</a></li>
                            <li class="nav-item rounded-0"><a class="nav-link" data-toggle="tab" href="#item-others">Others</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-8 col-xl-9">
                        <div class="row">
                            <div class="col">
                                <form id="setting-form" action="<?php echo e(route('admin.settings')); ?>" method="post" enctype="multipart/form-data">
                                    <div class="tab-content">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <?php echo $__env->make('admin.settings.general', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php echo $__env->make('admin.settings.company', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php echo $__env->make('admin.settings.social', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php echo $__env->make('admin.settings.others', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('assets/js/counter/jquery.counterup.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/counter/counter-custom.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function(){
        $('#setting-form').keyup(function(e) {
            return e.which !== 13  
        });

        $('#add-courier').click(function(e) {
            e.preventDefault();
            
            var id = 1, len = 0;
            if(len = ($(this).parents('.form-group').children('.input-group').length >= 1)) {
                id += len;
            }

            $(this).parents('.form-group').append(`<div class="input-group">
                                                        <input type="text" name="courier[]" value="" class="form-control">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text bg-danger remove-courier">&minus;</span>
                                                        </div>
                                                    </div>`).children('.input-group').last().hide().fadeIn(350);
        });

        $(document).on('click', '.remove-courier', function(){
            $(this).parents('.input-group').fadeOut(350, function() {
                $(this).remove();
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.light.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\XAMPP\htdocs\starter-kit\resources\views/admin/settings/__invoke.blade.php ENDPATH**/ ?>