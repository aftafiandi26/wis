<div class="modal-header">
    <h5 class="modal-title fw-bold" id="exampleModalLabel">Data EMployee</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="table-responsive">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    {{--  --}}
                    <table class="table table-condensed table-borderless">
                        <tbody>
                            <tr>
                                <td>NIK</td>
                                <th>: {{ $employee->nik }}</th>
                                <td>Employee Status</td>
                                <th>: {{ $employee->emp_status }}</th>
                                <th rowspan="5">
                                    <img src="{{ $noImg }}" alt="no-image" srcset=""
                                        class="img img-fluid img-thumbnail" style="max-width: 300; max-height: 200px;">
                                </th>
                            </tr>
                            <tr>
                                <td>First Name</td>
                                <th>: {{ $employee->first_name }}</th>
                                <td>Last Name</td>
                                <th>: {{ $employee->last_name }}</th>
                            </tr>
                            <tr>
                                <td>Department</td>
                                <th>: {{ $employee->department() }}</th>
                                <td>Gender</td>
                                <th>: {{ $employee->gender }}</th>
                            </tr>
                            <tr>
                                <td>Position</td>
                                <th colspan="2">: {{ $employee->position }}</th>
                            </tr>
                            <tr>
                                <td>Join Contract</td>
                                <th>: {{ $employee->join_contract }}</th>
                                <td>End Contract</td>
                                <th>: {{ $employee->end_contract }}</th>
                            </tr>
                        </tbody>
                    </table>
                    {{--  --}}
                </div>

            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <table class="table table-condensed table-borderless">
                        <tbody>
                            <tr>
                                <td>ID Card</td>
                                <th>: {{ $employee->id_card }}</th>
                                <td>Place of Birth</td>
                                <th>: {{ $employee->pob }}</th>
                                <td>Dirth of Date</td>
                                <th>: {{ $employee->bod }}</th>
                            </tr>
                            <tr>
                                <td>Province</td>
                                <th>: {{ $employee->province }}</th>
                                <td>Maiden Name</td>
                                <th>: {{ $employee->maiden }}</th>
                                <td>KK</td>
                                <th>: {{ $employee->kk }}</th>
                            </tr>
                            <tr>
                                <td>NPWP</td>
                                <th>: {{ $employee->npwp }}</th>
                                <td>BPJS Ketenagakerjaan</td>
                                <th>: {{ $employee->bpjs_ketenagakerjaan }}</th>
                                <td>BPJS Kesehatan</td>
                                <th>: {{ $employee->bpjs_kesehatan }}</th>
                            </tr>
                        </tbody>
                        @if ($employee->role_annual)
                            <tfoot>
                                <tr>
                                    <td>Annual</td>
                                    <th>: {{ $employee->role_annual->totalAnnual - $employee->role_annual->annual }}
                                    </th>
                                    <td>Exdo</td>
                                    <th>: {{ $employee->role_annual->totalExdo - $employee->role_annual->exdo }}</th>
                                </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-rounded btn-warning" id="modalEdit"
        data-bs-role="{{ route('employes.edit', $employee->id) }}"><i class="fas fa-edit"></i> Edit</button>
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
