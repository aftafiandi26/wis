<div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">Employee {{ $data->id }} </h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <img src="https://picsum.photos/200" alt="image" width="250px" height="300px" class="img img-fluid img-circle">
            </div>
            <div class="col-9">
                <table class="table table-condensed table-borderless">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <td>: {{ $data->nik }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>: {{ str()->title($data->fullname) }}</td>
                        </tr>
                        <tr>
                            <th>status</th>
                            <td>: {{ str()->ucfirst($data->emp_status) }}</td>
                        </tr>
                        <tr>
                            <th>Position</th>
                            <td>: {{ str()->title($data->position) }}</td>
                        </tr>
                        <tr>
                            <th>Department</th>
                            <td>: {{ str()->title($data->department_id) }}</td>
                        </tr>
                        <tr>
                            <th>Joined</th>
                            <td>:{{ $data->join_of_contract }}</td>
                        </tr>
                        <tr>
                            <th>Ended</th>
                            <td>:{{ $data->end_of_contract }}</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>