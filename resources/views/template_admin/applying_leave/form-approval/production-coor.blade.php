<div class="row">
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

    <div class="col-sm-4 col-md-2">
        @if (auth()->user()->need_producer == true)
            <div class="form-floating mb-3">
                <div class="row">
                    <label for="producer">Producer
                        <i class="fas fa-exclamation-circle"></i></label>
                </div>
                <div class="row">
                    <select name="producer" id="producer" class="form-select @error('producer') is-invalid @enderror"
                        data-width="100%">
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
        @endif
    </div>

    <div class="col-sm-4 col-md-2">
        <div class="form-floating mb-3">
            <div class="row">
                <label for="headof">Head of Department
                    <i class="fas fa-exclamation-circle"></i></label>
            </div>
            <div class="row">
                <select name="headof" id="headof" class="form-select @error('headof') is-invalid @enderror"
                    data-width="100%">
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
</div>
