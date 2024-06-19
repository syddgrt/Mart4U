<x-adminLayout>
  <main id="main" class="main">

    <!-- Breadcrumb -->
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active"><a href="/admin">Admin</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <!-- Card with header and footer -->
    <div class="card">
        <div class="card-body">
        @if( session('success') )
            <div class="alert alert-success">
                <h4>{{ session('success') }}!</h4>
            </div>
        @endif
        <h5 class="card-title">Admins</h5>
        <a class="btn btn-outline-primary float-right mb-4" href="{{ url('/admin/create')}}"><i class="bi bi-plus-circle-fill"></i> Add Admin</a>
        <table class="table table-hover">
          <thead>
            <tr>
              <!-- <th scope="col">No.</th> -->
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Register Date</th>
              <!-- <th scope="col">Action</th> -->
            </tr>
          </thead>
          <tbody>
            @unless(count($announcements) == 0)
            @foreach($announcements as $announcement)
            {{-- <h2> <a href="/announcement/{{$announcement['id']}}"> {{$announcement['title']}} </a></h2>
            <p> {{$announcement['description'] }}</p> --}}
            <tr>
              <!-- <th scope="row">{{$announcement->announcement_id}}</th> -->
              <td>{{ $announcement->name }}</td>
              <td>{{ $announcement->email }}</td>
              <td>{{ $announcement->created_at}}</td>
              <!-- <td>
                <a href="{{url('/edit-announcement/'.$announcement->announcement_id)}}" class="btn btn-primary">Edit</a>
                <br><br>
                <form action="{{url('/delete-announcement/'.$announcement->announcement_id)}}" method="post">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}

                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
              </td> -->
            </tr>
            @endforeach
            @else
            <p>No announcements found</p>
            @endunless
          </tbody>
        </table>

      </div>
    </div>



  </main>
</x-adminLayout>