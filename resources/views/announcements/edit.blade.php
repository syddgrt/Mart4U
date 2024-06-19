<x-adminLayout>

  <!-- <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </head> -->

  <main id="main" class="main">

    <!-- Breadcrumb -->
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active"><a href="/edit-announcement/{{ $announcement->announcement_id }}">Edit Announcement</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="card">
      <div class="card-body">

        <h5 class="card-title">Edit Announcement</h5>

        <form method="post" action="{{ url('edit-announcement/'.$announcement->announcement_id)}}">
          {{ csrf_field() }}
          {{method_field('PUT')}}

          <div class="form-group">
            <label for="exampleFormControlInput1">Announcement Title</label>
            <input type="text" name="announcement_name" value="{{old('announcement_name') ?? $announcement->announcement_name}}" class="form-control" id="exampleFormControlInput1" placeholder="Title">
          </div>

          <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea name="announcement_description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{old('announcement_description') ?? $announcement->announcement_description}}</textarea>
          </div>

          <div class="text-center">
            <button class="btn btn-secondary mt-3" type="reset">Reset</button>
            <button class="btn btn-primary mt-3">Update</button>
          </div>

      </div>

    </div>
    </form>
  </main>
</x-adminLayout>