@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Add New Note') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('notes.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="title" class="col-form-label">{{ __('Title') }}</label>

                            <div class="">
                                <input 
                                    id="title" type="text" 
                                    class="form-control 
                                    @error('title') is-invalid @enderror" 
                                    name="title" 
                                    value="{{ old('title') }}" 
                                    autocomplete="title" 
                                    autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="content" class="col-form-label">{{ __('Content') }}</label>

                            <div class="">
                                <textarea 
                                    id="content" 
                                    type="text" 
                                    class="form-control 
                                    @error('content') is-invalid @enderror" 
                                    name="content" value="{{ old('content') }}" 
                                    autocomplete="content"
                                >{{ old('content') }}</textarea>

                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add') }}
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
