<div class="modal fade js-corrections">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h4 class="modal-title">Новая правка</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Исправить</p>
                <p class="js-corrections-from"></p>
                <form method="post" action="{{ route('admin.corrections.create') }}" class="js-corrections-form">
                    <div class="form-group required">
                        <input type="text" class="form-control" placeholder="Исправить на ..." name="correction_to">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" placeholder="Комментарий" name="correction_comment"></textarea>
                    </div>
                    <input type="hidden" name="correction_from" value="">
                    <input type="hidden" name="correction_url" value="">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/corrections.js') }}"></script>
@endpush
