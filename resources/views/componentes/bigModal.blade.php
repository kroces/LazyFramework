<script>
    function formBigModal(title, load_url){
        $("#big-title").html(title);
        $.get(load_url, function (data){
            $("#big-modal-content").html(data);
        });
        $("#big-modal").modal('toggle');
    }
</script>

<div class="modal fade" id="big-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="big-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="big-modal-content">

                </div>
            </div>
        </div>
    </div>
</div>