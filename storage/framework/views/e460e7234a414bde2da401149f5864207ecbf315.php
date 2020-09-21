<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <link rel="icon" href="<?php echo e(asset($logo->favicon ?? '')); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo e(asset($logo->favicon ?? '')); ?>" type="image/x-icon">
    <title><?php echo e($company->name ?? ''); ?> - <?php echo $__env->yieldContent('title'); ?></title>
    <?php echo $__env->make('layouts.light.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('styles'); ?>
    <?php echo BladeUIKit\BladeUIKit::outputStyles(true); ?>
  </head>
  <body class="light-only" main-theme-layout="ltr">
    <?php $admin = auth('admin')->user() ?>
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="loader-index"><span></span></div>
      <svg>
        <defs></defs>
        <filter id="goo">
          <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
          <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">    </fecolormatrix>
        </filter>
      </svg>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <?php echo $__env->make('layouts.light.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>      
      <!-- Page Header Ends -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper sidebar-icon">
        <!-- Page Sidebar Start-->
        <?php echo $__env->make('layouts.light.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>        
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6">
                  <?php echo $__env->yieldContent('breadcrumb-title'); ?>                  
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('/')); ?>"><i data-feather="home"></i></a></li>
                    <?php echo $__env->yieldContent('breadcrumb-items'); ?>                    
                  </ol>
                </div>
                <div class="col-lg-6">
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
           <?php if (isset($component)) { $__componentOriginalb9e27f94758f80983421b793105195d9f2c26b61 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AlertBox::class, []); ?>
<?php $component->withName('alert-box'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalb9e27f94758f80983421b793105195d9f2c26b61)): ?>
<?php $component = $__componentOriginalb9e27f94758f80983421b793105195d9f2c26b61; ?>
<?php unset($__componentOriginalb9e27f94758f80983421b793105195d9f2c26b61); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
          <?php echo $__env->yieldContent('content'); ?>
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        <?php echo $__env->make('layouts.light.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>        
      </div>
    </div>
    <?php echo $__env->make('layouts.light.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
      window.slugify = function (src) {
        return src.toLowerCase()
            .replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, 'e')
            .replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, 'a')
            .replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, 'o')
            .replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, 'u')
            .replace(/đ/gi, 'd')
            .replace(/\s*$/g, '')
            .replace(/\s+/g, '-')
            .replace(/[\[,!:;{}=+%^()\/\\?><`~|\]]/g, '')
            .replace(/@/g, '-at-')
            .replace(/\$/g, '-dollar-')
            .replace(/#/g, '-hash-')
            .replace(/\*/g, '-star-')
            .replace(/&/g, '-and-')
            .replace(/-+/g, '-')
            .replace(/\.+/g, '');
    }
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo BladeUIKit\BladeUIKit::outputScripts(true); ?>
  </body>
</html><?php /**PATH E:\XAMPP\htdocs\starter-kit\resources\views/layouts/light/master.blade.php ENDPATH**/ ?>