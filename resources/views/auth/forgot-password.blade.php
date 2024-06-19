@extends('admin.layout.auth.layout')

@section('content')

<div class="card-body">
    
    <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4">{{ __('Forgot your password?') }}</h5>
        <p class="text-center small">{{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
    </div>

    <!-- <div>
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div> -->
    
    @if (session('status'))
    <div class="text-warning">
        {{ session('status') }}
    </div>
    @endif
    
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
    
    <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('password.email') }}">
        @csrf
        
        <div class="col-12">
            <label>{{ __('Email') }}</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus />
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary w-100">
                {{ __('Email Password Reset Link') }}
            </button>
        </div>

        <div class="col-12">
            <p class="small mb-0">Already have an account? <a href="/login">Login</a></p>
            <p class="small mb-0">Don't have account? <a href="/register">Create an account</a></p>
        </div>

    </form>
    
</div>

@endsection
