@extends('admin.layout.auth.layout')

@section('content')
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

    <div class="card-body">

        <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4">Create New Admin Account</h5>
        <p class="text-center small">Enter personal details to create account</p>
        </div>

        <form class="row g-3 needs-validation" method="POST" action="/admin" novalidate>
            @csrf

            <div class="col-12">
                <label for="yourName" class="form-label">Your Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus autocomplete="name">
                <div class="invalid-feedback">Please, enter your name!</div>
            </div>

            <div class="col-12">
                <label for="yourEmail" class="form-label">Your Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required >
                <div class="invalid-feedback">Please enter a valid email adddress!</div>
            </div>

            <!-- <div class="col-12">
                <label for="yourUsername" class="form-label">Username</label>
                <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="text" name="username" class="form-control" id="yourUsername" required>
                <div class="invalid-feedback">Please choose a username.</div>
                </div>
            </div> -->

            <div class="col-12">
                <label for="yourPassword" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required autocomplete="new-password" >
                <div class="invalid-feedback">Please enter your password!</div>
            </div>

            <div class="col-12">
                <label for="yourPassword" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required autocomplete="new-password" >
                <div class="invalid-feedback">Please enter your confirm password!</div>
            </div>

            <!-- <div class="col-12">
                <div class="form-check">
                <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                <div class="invalid-feedback">You must agree before submitting.</div>
                </div>
            </div> -->

            <div class="col-12">
                <button class="btn btn-primary w-100" type="submit">Create Account</button>
            </div>

            <div class="col-12">
                <p class="small mb-0">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
            </div>
        </form>

    </div>

    
@endsection
