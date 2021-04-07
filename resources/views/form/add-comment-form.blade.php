<form method="POST" action="{{ route('addComment', [$announcement->id]) }}">
    @csrf

    <div class="form-group row">

        <div class="col-md-12 mt-3">
                    <textarea id="text" type="text" class="form-control @error('text') is-invalid @enderror"
                              name="text" required autocomplete="text">{{trim(old('text'))}}</textarea>

            @error('text')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary">
                {{ __('Comment') }}
            </button>
        </div>
    </div>
</form>
