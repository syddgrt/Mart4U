@extends('admin.layout.auth.layout')

@section('content')
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

    <!-- <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label>{{ __('Email') }}</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus />
        </div>

        <div>
            <label>{{ __('Password') }}</label>
            <input type="password" name="password" required autocomplete="current-password" />
        </div>

        <div>
            <label>{{ __('Remember me') }}</label>
            <input type="checkbox" name="remember">
        </div>

        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
        @endif

        <div>
            <button type="submit">
               {{ __('Login') }}
            </button>
        </div>
    </form> -->




    <div class="card-body">

        <div class="pt-4 pb-2">
            <h5 class="card-title text-center pb-0 fs-4">Login to Admin Account</h5>
            <p class="text-center small">Enter your email & password to login</p>
        </div>

        <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('login') }}">
            @csrf

            <!-- <div class="col-12">
                <label for="yourUsername" class="form-label">Username</label>
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <div class="input-group has-validation">
                <input type="text" name="username" class="form-control" id="yourUsername" required>
                <div class="invalid-feedback">Please enter your username.</div>
                </div>
            </div> -->

            <div class="col-12">
                <label for="yourPassword" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus >
                <div class="invalid-feedback">Please enter your email!</div>
            </div>

            <div class="col-12">
                <label for="yourPassword" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required autocomplete="current-password">
                <div class="invalid-feedback">Please enter your password!</div>
            </div>

            <div class="col-12">
                <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary w-100" type="submit">Login</button>
            </div>
            <div class="col-12">
                <p class="small mb-0">Forgot password? <a href="/forgot-password">Reset you password</a></p>
                <!-- <p class="small mb-0">Don't have account? <a href="/register">Create an account</a></p> -->
            </div>
        </form>

    </div>
@endsection
