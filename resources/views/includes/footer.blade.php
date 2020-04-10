<!-- Modal -->
<div class="modal fade" id="confirm" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ _i('Delete Confirmation') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>{{ _i('Are you sure you want to delete?') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ _i('Cancel') }}</button>
                <button type="button" class="btn btn-primary" id="delete-btn">{{ _i('Delete') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
