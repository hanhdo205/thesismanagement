<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head></head><body>
	<p>
		<?php echo e($Name); ?>先生<br />
		いつも大変お世話になっております。<br>
		<?php echo e($Topic); ?>の査読依頼をさせていただければと思います。<br>
		以下のリンクより、ご確認してくださいませ。<br><br>
		<?php $__currentLoopData = $Link; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php
			$no = $key + 1;
		?>
		    <?php echo e($no); ?>: <a href="<?php echo e($value); ?>"><?php echo e($value); ?></a><br>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</p>
</body></html>