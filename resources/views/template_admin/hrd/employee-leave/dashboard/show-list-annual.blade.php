<div class="modal-header">
    <h5 class="modal-title fw-bold" id="exampleModalLabel">Annual Employee</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="container-fluid">

    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-rounded btn-warning" id="modalEdit"
        data-bs-role="#"><i class="fas fa-edit"></i> Show</button>
    <button type="button" class="btn btn-sm btn-rounded btn-secondary" data-bs-dismiss="modal">Close</button>
</div>

<script>
    $(document).ready(function() {
        $('button#modalEdit').replaceWith(function() {
            return $('<a>', {
                href: $(this).attr('data-bs-role'), // Sesuaikan href sesuai kebutuhan
                id: this.id,
                class: this.className,
                html: $(this).html() // Menggunakan teks atau HTML di dalam button
            });
        });
    })
</script>
