<div class="modal-header">
    <h5 class="modal-title fw-bold" id="exampleModalLabel">Update Data Role Access {{ $employee->fullname() }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<style>
    #togglePassword {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: none;
        cursor: pointer;
    }
</style>
<div class="modal-body">
    <div class="container-fluid">
        <form action="{{ route('management-role-access.update', $employee->role_user->id) }}" method="post" class="form-switch"
            enctype="application/x-www-form-urlencoded" id="formRoleAccessUpdate">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-sm-4 col-md-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                            placeholder="username" value="{{ $employee->role_user->username }}" name="username">
                        <label for="username">Username</label>
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-4 col-md-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            placeholder="name" value="{{ $employee->role_user->name }}" name="name">
                        <label for="name">Employee Name</label>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-4 col-md-4">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="email" value="{{ $employee->role_user->email }}" name="email">
                        <label for="email">Email</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-md-4">
                    <div class="form-floating mb-3">
                        <select class="form-select @error('department') is-invalid @enderror" name="department">
                            <option selected value="">Choose Department</option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}"
                                    @if ($employee->role_user->department_id) @selected(true) @endif>
                                    {{ $dept->name }}</option>
                            @endforeach
                        </select>
                        <label for="select">choose departmet</label>
                        @error('department')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" role="switch" id="checkOfficer" name="checkOfficer"
                            value="1" @if ($employee->role_user->officer == true) @checked(true) @endif>
                            Officer
                        </label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkProduction" name="checkProduction"
                            value="1" @if ($employee->role_user->production == true) @checked(true) @endif>
                        <label class="form-check-label" for="checkProduction">
                            Production
                        </label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkActived" name="checkActived"
                            value="1" @if ($employee->role_user->active == true) @checked(true) @endif>
                        <label class="form-check-label" for="checkActived">
                            @if ($employee->role_user->active == true)
                                <span id="statusTextActived">Actived</span>
                            @else
                                <span id="statusTextActived">Deactived</span>
                            @endif
                        </label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkSPV" name="checkSPV" value="1"
                            @if ($employee->role_user->spv == true) @checked(true) @endif>
                        <label class="form-check-label" for="checkSPV">
                            Supervisor
                        </label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkCoordinator" value="1"
                            name="checkCoordinator"
                            @if ($employee->role_user->coor == true) @checked(true) @endif>
                        <label class="form-check-label" for="checkCoordinator">
                            Coordinator
                        </label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkPM" name="checkPM"
                            value="1" @if ($employee->role_user->pm == true) @checked(true) @endif>
                        <label class="form-check-label" for="checkPM">
                            Project Manager
                        </label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkProducer" name="checkProducer"
                            value="1" @if ($employee->role_user->producer == true) @checked(true) @endif>
                        <label class="form-check-label" for="checkProducer">
                            Producer
                        </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkHOD" name="checkHOD"
                            value="1" @if ($employee->role_user->hod == true) @checked(true) @endif>
                        <label class="form-check-label" for="checkHOD">
                            Head Of Deaprtment
                        </label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkGM" name="checkGM"
                            value="1" @if ($employee->role_user->gm == true) @checked(true) @endif>
                        <label class="form-check-label" for="checkGM">
                            General Manager
                        </label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkVerify" name="checkVerify"
                            value="1" @if ($employee->role_user->verify == true) @checked(true) @endif>
                        <label class="form-check-label" for="checkVerify">
                            Verify
                        </label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkConfirmed" name="checkConfirmed"
                            value="1" @if ($employee->role_user->confirmed == true) @checked(true) @endif>
                        <label class="form-check-label" for="checkConfirmed">
                            Confirm
                        </label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkGrantAll" name="checkGrantAll"
                            value="1">
                        <label class="form-check-label" for="checkGrantAll">
                            Grant All
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkNeedSPV" name="checkNeedSPV"
                            value="1" @if ($employee->role_user->need_spv == true) @checked(true) @endif>
                        <label class="form-check-label" for="checkNeedSPV">
                            Need SPV
                        </label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkNeedCoor" name="checkNeedCoor"
                            value="1" @if ($employee->role_user->need_coor == true) @checked(true) @endif>
                        <label class="form-check-label" for="checkNeedCoor">
                            Need Coordinator
                        </label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkNeedPM" name="checkNeedPM"
                            value="1" @if ($employee->role_user->need_pm == true) @checked(true) @endif>
                        <label class="form-check-label" for="checkNeedPM">
                            Need PM
                        </label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkNeedProducer" value="1"
                            name="checkNeedProducer"
                            @if ($employee->role_user->need_producer == true) @checked(true) @endif>
                        <label class="form-check-label" for="checkNeedProducer">
                            Need Producer
                        </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkNeedHOD" name="checkNeedHOD"
                            value="1" @if ($employee->role_user->need_hod == true) @checked(true) @endif>
                        <label class="form-check-label" for="checkNeedHOD">
                            Need HOD
                        </label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkNeedGM" name="checkNeedGM"
                            value="1" @if ($employee->role_user->need_gm == true) @checked(true) @endif>
                        <label class="form-check-label" for="checkNeedGM">
                            Need GM
                        </label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkNeedVerify" name="checkNeedVerify"
                            value="1" @if ($employee->role_user->need_verify == true) @checked(true) @endif>
                        <label class="form-check-label" for="checkNeedVerify">
                            Need Verifying
                        </label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkNeedConfirmed" value="1"
                            name="checkNeedConfirmed"
                            @if ($employee->role_user->need_hr_manager == true) @checked(true) @endif>
                        <label class="form-check-label" for="checkNeedConfirmed">
                            Need Confirmed
                        </label>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-sm btn-success btn-rounded text-black" id="submitFormUpdate"><i
            class="fas fa-save"></i>
        Save</button>
    <button type="button" class="btn btn-sm btn-rounded btn-secondary" data-bs-dismiss="modal">Close</button>
</div>

<script>
    $(document).ready(function() {

        document.getElementById('checkActived').addEventListener('change', function() {
            let statusTextActived = document.getElementById('statusTextActived');
            if (this.checked) {
                // this.value = 'on'; // Jika checkbox dicentang
                statusTextActived.textContent = 'Activated';

            } else {
                // this.value = 'off'; // Jika checkbox tidak dicentang
                statusTextActived.textContent = 'Deactived';
            }

        });

        document.getElementById('checkGrantAll').addEventListener('change', function() {

            let statusCheckNeedSPV = document.getElementById('checkNeedSPV');
            let statusCheckNeedCoor = document.getElementById('checkNeedCoor');
            let statusCheckNeedPM = document.getElementById('checkNeedPM');
            let statusCheckNeedProducer = document.getElementById('checkNeedProducer');
            let statusCheckNeedHOD = document.getElementById('checkNeedHOD');
            let statusCheckNeedVerify = document.getElementById('checkNeedVerify');
            let statusChecNeedConfirmed = document.getElementById('checkNeedConfirmed');

            if (this.checked) {
                statusCheckNeedSPV.checked = true;
                statusCheckNeedCoor.checked = true;
                statusCheckNeedPM.checked = true;
                statusCheckNeedProducer.checked = true;
                statusCheckNeedHOD.checked = true;
                statusCheckNeedVerify.checked = true;
                statusChecNeedConfirmed.checked = true;

            } else {
                statusCheckNeedSPV.checked = false;
                statusCheckNeedCoor.checked = false;
                statusCheckNeedPM.checked = false;
                statusCheckNeedProducer.checked = false;
                statusCheckNeedHOD.checked = false;
                statusCheckNeedVerify.checked = false;
                statusChecNeedConfirmed.checked = false;
            }
        });

        document.getElementById('checkOfficer').addEventListener('change', function() {
            let statusCheckNeedHOD = document.getElementById('checkNeedHOD');
            let statusCheckNeedVerify = document.getElementById('checkNeedVerify');
            let statusChecNeedConfirmed = document.getElementById('checkNeedConfirmed');

            if (this.checked) {
                statusCheckNeedHOD.checked = true;
                statusCheckNeedVerify.checked = true;
                statusChecNeedConfirmed.checked = true;
            } else {
                statusCheckNeedHOD.checked = false;
                statusCheckNeedVerify.checked = false;
                statusChecNeedConfirmed.checked = false;
            }
        });

        document.getElementById('checkProduction').addEventListener('change', function() {
            let statusCheckNeedSPV = document.getElementById('checkNeedSPV');
            let statusCheckNeedCoor = document.getElementById('checkNeedCoor');
            let statusCheckNeedPM = document.getElementById('checkNeedPM');
            let statusCheckNeedProducer = document.getElementById('checkNeedProducer');
            let statusCheckNeedHOD = document.getElementById('checkNeedHOD');
            let statusCheckNeedVerify = document.getElementById('checkNeedVerify');
            let statusChecNeedConfirmed = document.getElementById('checkNeedConfirmed');

            if (this.checked) {
                statusCheckNeedSPV.checked = true;
                statusCheckNeedCoor.checked = true;
                statusCheckNeedPM.checked = true;
                statusCheckNeedProducer.checked = true;
                statusCheckNeedHOD.checked = true;
                statusCheckNeedVerify.checked = true;
                statusChecNeedConfirmed.checked = true;
            } else {
                statusCheckNeedSPV.checked = false;
                statusCheckNeedCoor.checked = false;
                statusCheckNeedPM.checked = false;
                statusCheckNeedProducer.checked = false;
                statusCheckNeedHOD.checked = false;
                statusCheckNeedVerify.checked = false;
                statusChecNeedConfirmed.checked = false;
            }
        });

        $('button#submitFormUpdate').on('click', function(e) {
            // e.preventDefault();
            $('form#formRoleAccessUpdate').submit();
        });

    });
</script>
