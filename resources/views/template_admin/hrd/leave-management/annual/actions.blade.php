@if ($annual)
    <a data-bs-role="{{ route('leave-management-annual.show', $id) }}"
        class="btn btn-link btn-primary btn-lg showDataTables" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
            class="fas fa-edit"></i></a>
@else
    <a data-bs-role="{{ route('leave-management-annual.edit', $id) }}" class="btn btn-link btn-warning btn-lg createData" data-bs-toggle="modal"
        data-bs-target="#exampleModal"><i class="fas fa-edit"></i></a>
@endif
