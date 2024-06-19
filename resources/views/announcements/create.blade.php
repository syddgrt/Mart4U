<x-adminLayout>
  <main id="main" class="main">
    <div class="card">
      <div class="card-body">

        <h5 class="card-title">Add Announcements</h5>

        <form method="post" action="{{ url('/add-announcement') }}">
          {{ csrf_field() }}

          <div class="form-group">
            <label for="exampleFormControlInput1">Announcement Title</label>
            <input type="text" name="announcement_name" class="form-control" id="exampleFormControlInput1" placeholder="Title">
          </div>

          <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea name="announcement_description" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Description"></textarea>
          </div>
          <div class="text-center">
            <button class="btn btn-secondary mt-3" type="reset">Reset</button>
            <button class="btn btn-primary mt-3">Add</button>
          </div>


        </form>
      </div>

    </div>
  </main>
</x-adminLayout>