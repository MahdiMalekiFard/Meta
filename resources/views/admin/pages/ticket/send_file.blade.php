@push('js')
    <script>
        $('#send_file').on('show.bs.modal', function (e) {
            var id = $(e.relatedTarget).data('ticket-id');
            $(e.currentTarget).find('input[name="ticket_id"]').val(id);
        });
        $("#form_modal_4").submit(function (e) {
            e.preventDefault();
            e.stopPropagation();
            var err_Input = $(this).find('input[aria-invalid=true]');
            console.log(0)
            if (!$(this)[0].checkValidity() || err_Input.length > 0) {
                Swal.fire("اخطار", 'لطفا به دقت فرم مد نظر را پر کنید', 'error');
                return false;
            }
            $(this)[0].submit();
            showLoading();
            return true;
        });
    </script>
@endpush

<div wire:ignore.self class="modal fade" id="send_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ارسال فایل</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="add_price_result"></div>
                <div>
                    @csrf
                    <input hidden type="text" name="ticket_id">
                    <input hidden type="text" name="comment" value="">
                    <div class="form-group">
                        <label>فایل مورد نظر</label>
                        <input wire:model.lazy="file" class="form-control" type="file"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="closeButton" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">بستن</button>
                <button class="btn btn-primary font-weight-bold" wire:click="sendFileMessage" wire:loading.attr="disabled" wire:target="file">ذخیره</button>
            </div>
        </div>
    </div>
</div>
