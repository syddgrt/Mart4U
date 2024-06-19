
<x-adminLayout>
    <main id="main" class="main">
        
        <!-- Breadcrumb -->
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active"><a href="/admin/{{ $user->id }}">Update Profile</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        @if( session('message') )
        <div class="alert alert-success">
            <h4>{{ session('message') }}!</h4>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Update Profile</h5>
                <form method="POST" action="/admin/{{ $user->id }}">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $user->name }}" name="name">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" value="{{ $user->email }}" name="email">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email Verification Date</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" value="{{ $user->email_verified_at }}" disabled>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- <label class="col-sm-2 col-form-label">Submit Button</label> -->
                        <div class="col-sm-10 text-center">
                            <button type="submit" class="btn btn-primary">Update Profile Data</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <!-- Change Password -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Change Password</h5>
                <form method="POST" action="/admin/change-password">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-sm-10 text-center">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </main>
</x-adminLayout>