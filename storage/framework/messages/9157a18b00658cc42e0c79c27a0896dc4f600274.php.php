<!-- Modal -->
<div class="modal" id="confirm" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo e(_i('Delete Confirmation')); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p><?php echo e(_i('Are you sure you want to delete?')); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(_i('Cancel')); ?></button>
                <button type="button" class="btn btn-primary" id="delete-btn"><?php echo e(_i('Delete')); ?></button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<?php echo e(__('user-list')); ?>

<?php echo e(__('user-create')); ?>

<?php echo e(__('user-edit')); ?>

<?php echo e(__('user-delete')); ?>

<?php echo e(__('role-list')); ?>

<?php echo e(__('role-create')); ?>

<?php echo e(__('role-edit')); ?>

<?php echo e(__('role-delete')); ?>

<?php echo e(__('topic-list')); ?>

<?php echo e(__('topic-create')); ?>

<?php echo e(__('topic-edit')); ?>

<?php echo e(__('topic-delete')); ?>

<?php echo e(__('essay-list')); ?>

<?php echo e(__('essay-create')); ?>

<?php echo e(__('essay-edit')); ?>

<?php echo e(__('essay-delete')); ?>

<?php echo e(__('user')); ?>

<?php echo e(__('role')); ?>

<?php echo e(__('topic')); ?>

<?php echo e(__('essay')); ?>

