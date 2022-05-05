@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tulis Curhat') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('TulisCurhatPost') }}">
                        @csrf

                        <div class="form-group row mb-3">
                            <label for="curhat" class="col-md-4 col-form-label text-md-right">{{ __('Isi') }}</label>

                            <div class="col-md-6">
                                <textarea id="curhat" type="text" class="form-control @error('curhat') is-invalid @enderror" name="curhat" value="{{ old('curhat') }}" required autocomplete="curhat" autofocus></textarea>

                                @error('curhat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-check form-switch">
                            <label class="form-check-label" for="anonymous">{{ __('Anonymous') }}</label>
                            <input class="form-check-input" type="checkbox" id="anonymous" name="anonymous" checked>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Tulis Curhat') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection