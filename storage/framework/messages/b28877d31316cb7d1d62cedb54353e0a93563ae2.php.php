<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    <div class="clearfix">
                        <div class="col-sm-12 text-center mb-3">
                        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">査読管理システム</a>
                      </div>
                      <h4 class="pt-3"><?php echo e(_i('Did you forget your password?')); ?></h4>
                      <p class="text-muted"><?php echo e(_i('Provide your email that you used to register. We will send you information on how to reset your password.')); ?></p>
                    </div>

                    <form method="POST" class="mb-5" action="<?php echo e(route('password.email')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="input-prepend input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                                </span>
                              </div>
                              <input class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email" size="16" name="email" type="email" placeholder="<?php echo e(_i('E-Mail Address')); ?>" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
                              <span class="input-group-append">
                                <button class="btn btn-primary" type="submit" name="forgetpass"><?php echo e(_i('Send')); ?></button>
                              </span>
                              <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>