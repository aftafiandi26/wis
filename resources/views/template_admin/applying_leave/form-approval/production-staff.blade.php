@if (auth()->user()->need_spv == true)
    <div class="row">
        @if (auth()->user()->need_spv == true)
            <div class="col-sm-4 col-md-2">
                <div class="form-floating mb-3">
                    <div class="row">
                        <label for="spv">Supervisor
                            <i class="fas fa-exclamation-circle"></i></label>
                    </div>
                    <div class="row">
                        <select name="spv" id="spv" class="form-select @error('spv') is-invalid @enderror"
                            data-width="100%" required>
                            <option value=""></option>
                            @foreach ($user_spv as $spv)
                                <option value="{{ $spv->role_employes->id }}">{{ $spv->role_employes->fullname() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        @error('spv')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        @endif
@endif

    @if (auth()->user()->need_coor == true)
        <div class="col-sm-4 col-md-2">
            <div class="form-floating mb-3">
                <div class="row">
                    <label for="coor">Coordinator
                        <i class="fas fa-exclamation-circle"></i></label>
                </div>
                <div class="row">
                    <select name="coor" id="coor" class="form-select @error('coor') is-invalid @enderror"
                        data-width="100%">
                        <option value=""></option>
                        @foreach ($user_coor as $coor)
                            <option value="{{ $coor->role_employes->id }}">{{ $coor->role_employes->fullname() }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    @error('coor')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->need_pm == true)
        <div class="col-sm-4 col-md-2">
            <div class="form-floating mb-3">
                <div class="row">
                    <label for="pm">Project Manager
                        <i class="fas fa-exclamation-circle"></i></label>
                </div>
                <div class="row">
                    <select name="pm" id="pm" class="form-select @error('pm') is-invalid @enderror"
                        data-width="100%">
                        <option value=""></option>
                        @foreach ($user_pm as $pm)
                            <option value="{{ $pm->role_employes->id }}">{{ $pm->role_employes->fullname() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    @error('pm')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->need_producer == true)
        <div class="col-sm-4 col-md-2">
            <div class="form-floating mb-3">
                <div class="row">
                    <label for="producer">Producer
                        <i class="fas fa-exclamation-circle"></i></label>
                </div>
                <div class="row">
                    <select name="producer" id="producer" class="form-select @error('producer') is-invalid @enderror"
                        data-width="100%">
                        <option value=""></option>
                        @foreach ($user_producer as $producer)
                            <option value="{{ $producer->role_employes->id }}">
                                {{ $producer->role_employes->fullname() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    @error('producer')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->need_hod == true)
        <div class="col-sm-4 col-md-2">
            <div class="form-floating mb-3">
                <div class="row">
                    <label for="headof">Head of Department
                        <i class="fas fa-exclamation-circle"></i></label>
                </div>
                <div class="row">
                    <select name="headof" id="headof" class="form-select @error('headof') is-invalid @enderror"
                        data-width="100%">
                        <option value=""></option>
                        @foreach ($user_hod as $hod)
                            <option value="{{ $hod->role_employes->id }}">
                                {{ $hod->role_employes->fullname() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    @error('headof')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->need_gm == true)
        <div class="col-sm-4 col-md-2">
            <div class="form-floating mb-3">
                <div class="row">
                    <label for="gm">General Manager
                        <i class="fas fa-exclamation-circle"></i></label>
                </div>
                <div class="row">
                    <select name="gm" id="gm" class="form-select @error('gm') is-invalid @enderror"
                        data-width="100%">
                        <option value=""></option>
                        @foreach ($user_hod as $hod)
                            <option value="{{ $hod->role_employes->id }}">
                                {{ $hod->role_employes->fullname() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    @error('gm')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
    @endif
</div>
