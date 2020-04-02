<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo $__env->yieldContent('description'); ?>">
    <meta name="keyword" content="<?php echo $__env->yieldContent('keyword'); ?>">
	<title><?php echo e(config('app.name', 'Laravel')); ?> - <?php echo $__env->yieldContent('title'); ?></title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php if(auth()->guard()->guest()): ?>
<!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/login.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldContent('content'); ?>
    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
<?php else: ?>
    <!-- Styles -->
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
         <!-- Font-awesome style -->
        <link href="<?php echo e(asset('css/font-awesome.css')); ?>" rel="stylesheet" />
        <!-- Styles for this template-->
        <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet">
        <!-- Scrollbar styles for sidebar-->
        <link href="<?php echo e(asset('css/perfect-scrollbar.css')); ?>" rel="stylesheet">
        <!-- Datepicker styles-->
        <link href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
        <!-- Select2 styles-->
        <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>;
            var base_url = '<?php echo e(url('/')); ?>';
        </script>
        <!-- Jquery scripts -->
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <!-- App scripts -->
        <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    </head>
    <body>
            <div id="wrapper">
                    <?php echo $__env->make('includes.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div id="page-wrapper">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                    <!-- /. PAGE WRAPPER  -->
                    <?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <!-- /# WRAPPER  -->
        <!-- Select2 script -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
        <!-- Datepicker script -->
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="<?php echo e(asset('js/datepicker-ja.js')); ?>"></script>
        <!-- Scrollbar script -->
        <script src="<?php echo e(asset('js/perfect-scrollbar.jquery.js')); ?>"></script>
        <!-- Custom script -->
        <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
<?php endif; ?>
</body>
</html>