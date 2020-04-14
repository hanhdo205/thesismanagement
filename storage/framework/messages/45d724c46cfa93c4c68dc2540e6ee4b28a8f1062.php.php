<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head></head><body>
	<p>
		<?php echo e($Name); ?>先生<br />
		Please follow by these link below to review the essays:<br><br>
		<?php $__currentLoopData = $Link; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php
			$no = $key + 1;
		?>
		    <?php echo e($no); ?>: <a href="<?php echo e($value); ?>"><?php echo e($value); ?></a><br>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</p>
</body></html>