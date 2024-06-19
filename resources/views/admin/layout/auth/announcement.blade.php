<x-adminLayout>
  <main id="main" class="main">

    <!-- Breadcrumb -->
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active"><a href="/announcement">Announcement</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <!-- Card with header and footer -->
    <div class="card">
      <div class="card-body">

        <h5 class="card-title">Announcements</h5>
        <a class="btn btn-outline-primary float-right mb-4" href="{{ url('/add-announcement')}}"><i class="bi bi-plus-circle-fill"></i> Add Announcement</a>
        <table class="table table-hover">
          <thead>
            <tr>
              <!-- <th scope="col">No.</th> -->
              <th scope="col">Name</th>
              <th scope="col">Description</th>
              <th scope="col">Date</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @unless(count($announcements) == 0)
            @foreach($announcements as $announcement)
            {{-- <h2> <a href="/announcement/{{$announcement['id']}}"> {{$announcement['title']}} </a></h2>
            <p> {{$announcement['description'] }}</p> --}}
            <tr>
              <!-- <th scope="row">{{$announcement->announcement_id}}</th> -->
              <td>{{ $announcement->announcement_name }}</td>
              <td>{{ $announcement->announcement_description }}</td>
              <td>{{ $announcement->updated_at}}</td>
              <td>
                <a href="{{url('/edit-announcement/'.$announcement->announcement_id)}}" class="btn btn-primary">Edit</a>
                <!-- </td> -->
                <!-- <td> -->
                <br><br>
                <form action="{{url('/delete-announcement/'.$announcement->announcement_id)}}" method="post">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}

                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
              </td>
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