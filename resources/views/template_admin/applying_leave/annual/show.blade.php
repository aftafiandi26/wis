<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <h5 class="modal-title fw-bold text-center" id="progressModalLabel">Leave Application Form</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <table class="table table-borderless ">
                    <tbody>
                        <tr>
                            <td>Request By</td>
                            <th>: {{ $query->role_employee->first()->fullname() }}</th>
                            <td></td>
                            <td></td>
                            <td>NIK</td>
                            <th>: {{ $query->role_employee->first()->nik }}</th>
                        </tr>
                        <tr>
                            <td>Period</td>
                            <th>: {{ $query->period }}</th>
                            <td></td>
                            <td></td>
                            <td>Position</td>
                            <th>: {{ $query->role_employee->first()->position }}</th>
                        </tr>
                        <tr>
                            <td>Join Date</td>
                            <th>: {{ $query->role_employee->first()->join_contract }}</th>
                            <td></td>
                            <td></td>
                            <td>Department</td>
                            <th>: {{ $query->role_employee->first()->department() }}</th>
                        </tr>
                        <tr>
                            <td>Contact Address</td>
                            <th>: {{ $query->role_employee->first()->address() }}</th>
                        </tr>
                        <tr>
                            <td>Leave Category</td>
                            <th>: {{ $query->getLeaveCategory() }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <h5 class="modal-title fw-bold text-center" id="progressModalLabel">Personal Verification</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <table class="table table-borderless ">
                    <tbody>
                        <tr>
                            <td>Period</td>
                            <td>Entitlement</td>
                            <td>Taken</td>
                            <td>Pending</td>
                            <td>Requested</td>
                            <td>Balance</td>
                        </tr>
                        <tr>
                            <th>{{ $query->period }}</th>
                            <th>{{ $query->entitlement }}</th>
                            <th>{{ $query->taken }}</th>
                            <th>{{ $query->pending }}</th>
                            <th>{{ $query->total_day }}</th>
                            <th>{{ $query->remains }}</th>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Approved leave from</td>
                            <th>: {{ $query->start_leave }}</th>
                            <td>until</td>
                            <th>{{ $query->end_leave }}</th>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Back to work on</td>
                            <th>: {{ $query->back_work }}</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Contact phone during leave</td>
                            <th>: {{ $query->role_employee->first()->phone }}</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Reason:</td>
                        </tr>
                        <tr>
                            <th>{{ $query->reason }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12">
                <table class="table table-sm table-borderless" id="tableStatusApproved">
                    <tbody>
                        <tr>
                            <td>
                                <span>Status Approved</span>
                                <ul>
                                    @if ($query->role_user->first()->need_spv == true)
                                        <li>Supervisor : {{ $query->employee($query->spv_id)->fullname() }}
                                            <i>({{ $query->parmStatusApproved($query->ap_spv) }})
                                                ({{ $query->date_spv }})
                                            </i>
                                        </li>
                                    @endif
                                    @if ($query->role_user->first()->need_coor == true)
                                        <li>Coordinator : {{ $query->employee($query->coor_id)->fullname() }}
                                            <i>({{ $query->parmStatusApproved($query->ap_coor) }})
                                                ({{ $query->date_coor }})
                                            </i>
                                        </li>
                                    @endif
                                    @if ($query->role_user->first()->need_pm == true)
                                        <li>Project Manager : {{ $query->employee($query->pm_id)->fullname() }}
                                            <i>({{ $query->parmStatusApproved($query->ap_pm) }})
                                                ({{ $query->date_pm }})
                                            </i>
                                        </li>
                                    @endif
                                    @if ($query->role_user->first()->need_producer == true)
                                        <li>Producer : {{ $query->employee($query->producer_id)->fullname() }}
                                            <i>({{ $query->parmStatusApproved($query->ap_producer) }})
                                                ({{ $query->date_producer }})
                                            </i>
                                        </li>
                                    @endif
                                    @if ($query->role_user->first()->need_hod == true)
                                        <li>Head of Department : {{ $query->employee($query->hd_id)->fullname() }}
                                            <i>({{ $query->parmStatusApproved($query->ap_hd) }})
                                                ({{ $query->date_hd }})
                                            </i>
                                        </li>
                                    @endif
                                    @if ($query->role_user->first()->need_verify == true)
                                        <li>HR Verified : {{ $query->employee($query->hr_id)->fullname() }}
                                            <i>({{ $query->parmStatusApproved($query->ver_hr) }})
                                                ({{ $query->date_hr }})
                                            </i>
                                        </li>
                                    @endif
                                    @if ($query->role_user->first()->need_hr_manager == true)
                                        <li>HR Confirmed : {{ $query->employee($query->hrd_id)->fullname() }}
                                            <i>({{ $query->parmStatusApproved($query->ver_hrd) }})
                                                ({{ $query->date_hrd }})
                                            </i>
                                        </li>
                                    @endif
                                    @if ($query->role_user->first()->need_gm == true)
                                        <li>General Manager : {{ $query->employee($query->gm_id)->fullname() }}
                                            <i>({{ $query->parmStatusApproved($query->ap_gm) }})</i>
                                            ({{ $query->date_gm }})
                                        </li>
                                    @endif

                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    @if ($query->role_user->officer == true or $query->role_user->production == true)
        @if ($query->ap_hd == false)
            <button type="button" class="btn btn-sm btn-rounded btn-danger" id="buttonDelete"
                data-bs-role="{{ route('applying-leave-annual-modal.delete', $query->id) }}"><i
                    class="fas fa-trash"></i>
                Delete</button>
        @endif
    @endif

    <button type="button" class="btn btn-sm btn-rounded btn-info" id="download"
        data-bs-role="{{ route('applying-leave-dashboard.show', $query->id) }}"><i class="fas fa-download"></i>
        Download</button>
    <button type="button" class="btn btn-sm btn-rounded btn-secondary" data-bs-dismiss="modal">Close</button>
</div>

<script>
    $(document).ready(function() {
        $('button#download').replaceWith(function() {
            return $('<a>', {
                href: $(this).data('bs-role'), // Menggunakan href dari data-bs-role
                id: this.id,
                class: this.className,
                html: $(this).html(), // Menggunakan teks atau HTML di dalam button
                target: '_blank' // Menambahkan target="_blank" untuk membuka di tab baru
            });
        });
    });
</script>
