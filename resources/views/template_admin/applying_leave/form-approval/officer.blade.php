<div class="row">
    @if (auth()->user()->hod == false)
        @if (auth()->user()->need_coor == true)
            <div class="col-sm-4 col-md-2">
                <div class="form-floating mb-3">
                    <div class="row">
                        <label for="coor">Coordinator
                            <i class="fas fa-exclamation-circle"></i></label>
                    </div>
                    <div class="row">
                        <select name="coor" id="coor" class="form-select @error('coor') is-invalid @enderror"
                            data-width="100%" required>
                            <option value=""></option>
                            @foreach ($user_coor as $coor)
                                <option value="{{ $coor->role_employes->id }}">
                                    {{ $coor->role_employes->fullname() }}</option>
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

        {{--  --}}
        @if (auth()-<user()->need_hod == true)
            <div class="col-sm-4 col-md-2">
                <div class="form-floating mb-3">
                    <div class="row">
                        <label for="headof">Head of Department
                            <i class="fas fa-exclamation-circle"></i></label>
                    </div>
                    <div class="row">
                        <select name="headof" id="headof" class="form-select @error('headof') is-invalid @enderror"
                            data-width="100%" required>
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
        {{--  --}}
    @endif
    @if (auth()->user()->hod == true)
        @if (auth()->user()->need_gm == true)
            <div class="col-sm-4 col-md-2">
                <div class="form-floating mb-3">
                    <div class="row">
                        <label for="gm">General Manager
                            <i class="fas fa-exclamation-circle"></i></label>
                    </div>
                    <div class="row">
                        <select name="gm" id="gm" class="form-select @error('gm') is-invalid @enderror"
                            data-width="100%" required>
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
    @endif
</div>
