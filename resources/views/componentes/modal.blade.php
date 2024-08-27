<script>
    function formModal(title, load_url){
        $("#title").html(title);
        $.get(load_url, function (data){
            $("#modal-content").html(data);
        });
        $("#modal").modal('toggle');
    }
</script>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modal-content">

                </div>
            </div>
        </div>
    </div>
</div>