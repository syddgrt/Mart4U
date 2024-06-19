@extends('admin.layout.auth.layout')

@section('content')


    <div class="card-body">
    
        @if ($errors->any())
            <div class="text-danger">
                <div>{{ __('Whoops! Something went wrong.') }}</div>
        
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="pt-4 pb-2">
            <h5 class="card-title text-center pb-0 fs-4">{{ __('Create new password') }}</h5>
            <p class="text-center small">{{ __('Please enter your new password.') }}</p>
        </div>

        <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="col-12">
                <label>{{ __('Email') }}</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $request->email) }}" required autofocus readonly />
            </div>

            <div class="col-12">
                <label>{{ __('Password') }}</label>
                <input type="password" class="form-control" name="password" required autocomplete="new-password" />
            </div>

            <div class="col-12">
                <label>{{ __('Confirm Password') }}</label>
                <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary w-100">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>

    </div>

@endsection
