<div class="modal-header">
    <h5 class="modal-title fw-bold" id="exampleModalLabel">Annual Employee</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="table-responsive">
            <div class="row">
                <div class="col-sm-12 col-md-12"> {{--  --}}
                    <table class="table table-condensed table-borderless">
                        <tbody>
                            <tr>
                                <td>NIK</td>
                                <th>: {{ $employee->nik }}</th>
                                <td>Department</td>
                                <th>: {{ $employee->department() }}</th>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <th>: {{ $employee->fullname() }}</th>
                                <td>Position</td>
                                <th>: {{ $employee->position }}</th>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <th>: {{ $employee->emp_status }}</th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <form method="post" id="formPost">
                                <tr>
                                    <td>Join Contract</td>
                                    <th>
                                        <input type="date" name="joinContract" id="joinContract"
                                            value="{{ $employee->join_contract }}" class="form-control">
                                    </th>
                                    <td>End Contract</td>
                                    <th>
                                        <input type="date" name="endContract" id="endContract" class="form-control"
                                            value="{{ $employee->end_contract }}"
                                            @if ($employee->emp_status == 'Permanent') @readonly(true) @endif>
                                    </th>
                                </tr>
                            </form>
                            <tr>
                                <td>Remains Annual <sup>(before)</sup></td>
                                <th>: 0</th>
                                <td>Add Annual <sup>(after)</sup> </td>
                                <th>
                                    <input type="number" name="" id="addAnnual" value="0" min="0"
                                        class="form-control" @if ($employee->emp_status !== 'Permanent') @readonly(true) @endif>
                                </th>
                            </tr>
                            <tr>
                                <td>Annual</td>
                                <th>: <span id="annual">0</span></th>
                            </tr>
                        </tfoot>
                    </table>
                    {{--  --}}
                </div>

            </div>

        </div>
    </div>
</div>
<div class="modal-footer">
    <form action="{{ route('leave-management-annual.store') }}" method="post">
        @csrf
        <input type="text" name="id" class="form-control" hidden value="{{ $employee->id }}" @readonly(true)>
        <input type="date" name="joinContractPUT" id="joinContractPUT" value="{{ $employee->join_contract }}" hidden
            class="form-control">
        <input type="date" name="endContractPUT" id="endContractPUT" class="form-control" hidden
            value="{{ $employee->end_contract }}" @if ($employee->emp_status == 'Permanent') @readonly(true) @endif>
        <input type="number" name="annual" id="addAnnualPUT" value="0" min="0" class="form-control" hidden
            @if ($employee->emp_status !== 'Permanent') @readonly(true) @endif>

        <button type="submit" class="btn btn-sm btn-rounded btn-warning" id="modalUpdate"><i class="fas fa-edit"></i>
            Update</button>
    </form>
    <button type="button" class="btn btn-sm btn-rounded btn-secondary" data-bs-dismiss="modal">Close</button>
</div>

<script>
    $(document).ready(function() {

        $('input#joinContract').on('change', function() {
            document.getElementById('joinContractPUT').value = $(this).val();
        });

        $('input#endContract').on('change', function() {
            document.getElementById('endContractPUT').value = $(this).val();
        });

        function calculateFullMonths(startDate, endDate) {
            // Konversi string tanggal menjadi objek Date
            let start = new Date(startDate);
            let end = new Date(endDate);

            // Awal logika, hitung bulan
            let fullMonths = 0;

            // Iterasi melalui bulan antara start dan end
            while (start <= end) {
                // Tentukan awal dan akhir bulan saat ini
                let startOfMonth = new Date(start.getFullYear(), start.getMonth(), 1);
                let endOfMonth = new Date(start.getFullYear(), start.getMonth() + 1, 0); // Akhir bulan

                // Tentukan rentang hari yang termasuk dalam bulan ini
                let effectiveStart = start > startOfMonth ? start : startOfMonth;
                let effectiveEnd = end < endOfMonth ? end : endOfMonth;

                // Hitung jumlah hari dalam rentang bulan
                let daysInMonth = (effectiveEnd - effectiveStart) / (1000 * 60 * 60 * 24) + 1;

                // Periksa apakah bulan ini memenuhi syarat (28 hari atau lebih)
                if (daysInMonth > 27) {
                    fullMonths++;
                }

                // Pindah ke bulan berikutnya
                start.setMonth(start.getMonth() + 1);
                start.setDate(1); // Reset ke awal bulan
            }

            return fullMonths;
        }

        const startDate = "{{ $employee->end_contract }}";
        const annual = 0;
        const empStat = "{{ $employee->emp_status }}";

        if (empStat == "Permanent") {
            $('input#addAnnual').on('input', function() {
                let after = $(this).val();

                let resultAnnual = parseInt(annual) + parseInt(after);
                document.getElementById('annual').innerText = resultAnnual;
                document.getElementById('addAnnualPUT').value = resultAnnual;
            });
        } else {
            $('input#endContract').on('change', function() {
                const endDate = $(this).val();

                const calMonth = calculateFullMonths(startDate, endDate);

                document.getElementById('addAnnual').value = calMonth;
                document.getElementById('addAnnualPUT').value = calMonth;

                let resultAnnual = parseInt(annual) + parseInt(calMonth);

                document.getElementById('annual').innerText = resultAnnual;
            });
        }




    });
</script>
