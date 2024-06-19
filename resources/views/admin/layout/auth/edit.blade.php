<x-adminLayout>
  <main id="main" class="main">

    <!-- Breadcrumb -->
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active"><a href="/listings/{{ $listing->stock_id }}/edit">Edit Stock Management</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Edit an existing stock</h5>
        <header class="text-center">
          <p class="mb-4">Item to be edited: {{$listing->stock_name}}</p>
        </header>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-sm-8">
              <form method="POST" action="/listings/{{$listing->stock_id}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                  <label for="stock_name" class="col-sm-2 col-form-label">Stock Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="staticEmail" name="stock_name" value="{{$listing->stock_name}}">
                    @error('stock_name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <br>
                <div class="form-group row">
                  <label for="stock_price" class="col-sm-2 col-form-label">Stock Price</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="stock_price" id="stock_price" value="{{$listing->stock_price}}">
                    @error('stock_price')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <br>
                <div class="form-group row">
                  <label for="stock_quantity" class="col-sm-2 col-form-label">Stock Quantity</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="stock_quantity" id="stock_quantity" value="{{$listing->stock_quantity}}">
                    @error('stock_quantity')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <br>
                <div class="form-group row">
                  <label for="tags" class="col-sm-2 col-form-label">Tags</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="tags">
                      {{-- <option value="{{ $listing->tags }}" @selected(old('tags') == $listing->tags)>
                      {{ $listing->tags }}
                      </option> --}}
                      <option>Please select ...</option>
                      <option value="Drink" {{ $listing->tags == "Drink" ? 'selected': ''}}>Drink</option>
                      <option value="Food" {{ $listing->tags == "Food" ? 'selected': ''}}>Food</option>
                      <option value="Snack" {{ $listing->tags == "Snack" ? 'selected': ''}}>Snack</option>
                      <option value="Toy" {{ $listing->tags == "Toy" ? 'selected': ''}}>Toy</option>
                      <option value="Stanionery" {{ $listing->tags == "Stanionery" ? 'selected': ''}}>Stanionery</option>
                    </select>
                    @error('tags')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                  </div>
                  {{-- <div class="col-sm-10">
                        <input type="text" class="form-control" name="tags" id="tags" value="{{$listing->tags}}">
                  @error('tags')
                  <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                  @enderror
                </div> --}}
            </div>
            <br>
            <div class="form-group row">
              <label for="stock_image" class="col-sm-2 col-form-label">Stock Image</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" name="stock_image" id="stock_image" />
                <br>
                <img class="w-48 mr-6 mb-6" src="{{$listing->stock_image ? asset('storage/' . $listing->stock_image) : asset("https://dummyimage.com/450x300/dee2e6/6c757d.jpg")}}" style="height: 250px; width: 200px;" alt="" />
                @error('stock_image')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
              </div>
            </div>
            <br>
            <div class="form-group row">
              <label for="stock_description" class="col-sm-2 col-form-label">Stock Description</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="stock_description" id="stock_description" rows="10">{{$listing->stock_description}}</textarea>
                @error('stock_description')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
              </div>
            </div>
            <br>
            <div class=" row justify-content-center">
              <button type="submit" class="btn btn-dark">
                Update Stock
              </button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <a href="/stock" class="text-black ml-4"> Back </a>
    </div>
    </div>

  </main>
</x-adminLayout>