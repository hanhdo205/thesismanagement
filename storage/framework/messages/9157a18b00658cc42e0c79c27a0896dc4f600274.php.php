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
