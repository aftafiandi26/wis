<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $titleName }}</title>
    @include('layouts.template_admin.style')
</head>
<style>
    body {
        font-size: 12px;
        background-color: white;
        color: black;
    }

    table {
        width: 100%;
        vertical-align: top;
    }

    .text-printed {
        font-style: italic;
        font-weight: normal;
        font-size: 10px;
        text-align: right;
    }

    .hidden {
        color: transparent;
    }

    .text-bold {
        font-weight: bold;
    }

    .text-leave-header {
        font-weight: bold;
        font-size: 20px;
        text-align: center;
    }

    .row {
        margin-bottom: 20px;
        padding: 10px;
    }

    table.table-personal,
    .table-personal tbody tr,
    .table-personal tbody tr td,
    .table-personal tbody tr th {
        border: 1px;
        border-style: outset;
    }

    .table-personal tbody tr th,
    .table-personal tbody tr td {
        text-align: center;
        padding: 3px;
    }

    .padding tbody tr td,
    .padding tbody tr th {
        padding: 3px;
    }

    img.img {
        width: 150px;
        height: 50px;
        float: right;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 pull-right">
                <img src="{{ $iconic }}" class="img img-fluid">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <h5 class="text-leave-header text-center akaya-telivigala-regular ">Leave Application Form</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <table class="table padding">
                    <tbody>
                        <tr>
                            <td>Request By</td>
                            <th width="20%">: {{ $query->role_employee->fullname() }}</th>
                            <td></td>
                            <td></td>
                            <td>NIK</td>
                            <th width="20%">: {{ $query->role_employee->nik }}</th>
                        </tr>
                        <tr>
                            <td>Period</td>
                            <th>: {{ $query->period }}</th>
                            <td></td>
                            <td></td>
                            <td>Position</td>
                            <th>: {{ $query->role_employee->position }}</th>
                        </tr>
                        <tr>
                            <td>Join Date</td>
                            <th>: {{ date('d F Y', strtotime($query->role_employee->join_contract)) }}</th>
                            <td></td>
                            <td></td>
                            <td>Department</td>
                            <th>: {{ $query->role_employee->department() }}</th>
                        </tr>
                        <tr>
                            <td>Contact Address</td>
                            <th colspan="4">: {{ $query->role_employee->address() }}</th>
                        </tr>
                        <tr>
                            <td>Leave Category</td>
                            <th colspan="4">: {{ $query->getLeaveCategory() }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <h5 class="text-leave-header text-center" id="progressModalLabel">Personal Verification</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <table class="table table-personal">
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
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12">
                <table class="table padding">
                    <tbody>
                        <tr>
                            <td>Approved leave from</td>
                            <th width="20%">: {{ date('d F Y', strtotime($query->start_leave)) }}</th>
                            <td>until</td>
                            <th width="20%">{{ date('d F Y', strtotime($query->end_leave)) }}</th>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Back to work on</td>
                            <th>: {{ date('d F Y', strtotime($query->back_work)) }}</th>
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
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row" style="margin-bottom: 20px;">
            <div class="col-sm-12 col-md-12">
                <table class="table table-sm padding" id="tableStatusApproved">
                    <tbody>
                        <tr>
                            <td>
                                <span>Status Approved</span>
                                <ul>
                                    @if ($query->role_user->first()->need_spv == true)
                                        <li>Supervisor : {{ $query->employee($query->spv_id)->fullname() }}
                                            <i>{{ "($query->parmStatusApproved($query->ap_spv))" }}
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
    @include('layouts.template_admin.script')
</body>


</html>
