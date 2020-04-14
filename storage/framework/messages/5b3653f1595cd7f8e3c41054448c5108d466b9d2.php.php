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
    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <!-- Font-awesome style -->
    <link href="<?php echo e(asset('css/font-awesome.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('css/login.css')); ?>" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet">
     <!-- Datepicker styles-->
    <link href="<?php echo e(asset('css/jquery-ui.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldContent('content'); ?>
    <!-- Jquery scripts -->
    <script src="<?php echo e(asset('js/jquery-1.12.4.js')); ?>"></script>
    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <!-- Datepicker script -->
    <script src="<?php echo e(asset('js/jquery-ui.js')); ?>"></script>
    <script src="<?php echo e(asset('js/datepicker-ja.js')); ?>"></script>
    <!-- Custom script -->
    <script src="<?php echo e(asset('js/guess.js')); ?>"></script>
</body>
</html>