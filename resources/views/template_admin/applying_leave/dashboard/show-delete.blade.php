<div class="modal-header">
    <h5 class="modal-title fw-bold" id="exampleModalLabel">Do you want delete this annual form?</h5>
</div>
<div class="modal-body" style="text-align: center;">
    <button type="button" class="btn btn-sm btn-rounded btn-danger" id="modal2Yes"
        data-bs-role="{{ route('applying-leave-annual.destroy', $id) }}">Yes, delete this!</button>
    <button type="button" class="btn btn-sm btn-rounded btn-secondary" id="modal2CLose">No, cancel please!</button>
</div>
<div class="modal-footer">
    <p style="color: grey; font-size: 12px;"><i>Note: please confirmed!!</i></p>
</div>

<form action="{{ route('applying-leave-annual.destroy', $id) }}" method="post" id="formDelete">
    @csrf
    @method('DELETE')
</form>
<script>
    $(document).ready(function() {
        $('button#modal2CLose').on('click', function() {
            window.location.reload();
        });
        $('button#modal2Yes').on('click', function(e) {
            $('form#formDelete').submit();
        });
    });
</script>
