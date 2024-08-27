<script>
    function confirmModal(title, url, desc="Esta operación requiere confirmación"){
        $("#title-confirm-modal").html(title);
        $("#form-confirm-modal").attr("action",url);
        $("#modal-description").html(desc);
        $("#confirm").modal();
    }
</script>

<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-confirm-modal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-end">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-warning" role="alert" id="modal-description"></div>
                        </div>
                        <div class="col-12">
                            <form id="form-confirm-modal" method="post">
                                <div id="msg"></div>
                                @csrf
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <input type="submit" value="Confirmar" class="btn btn-success">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>