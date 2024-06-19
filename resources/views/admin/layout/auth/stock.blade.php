<x-adminLayout>
  <main id="main" class="main">

    <!-- Breadcrumb -->
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active"><a href="/stock">Stock Management</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    
    <!-- Card with header and footer -->
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Stock Management </h5>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#Createstock">
          <i class="bi bi-plus-circle-fill"></i> Add Product
        </button>
        <div class="modal fade" id="Createstock" tabindex="-1">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title card-title">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="POST" action="/listings" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group row">
                    <label for="stock_name" class="col-sm-2 col-form-label">Stock Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="staticEmail" name="stock_name" value="{{old('stock_name')}}">
                      @error('stock_name')
                      <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <br>
                  <div class="form-group row">
                    <label for="stock_price" class="col-sm-2 col-form-label">Stock Price</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="stock_price" id="stock_price" placeholder="1.00" value="{{old('stock_price')}}">
                      @error('stock_price')
                      <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <br>
                  <div class="form-group row">
                    <label for="stock_quantity" class="col-sm-2 col-form-label">Stock Quantity</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="stock_quantity" id="stock_quantity" value="{{old('stock_quantity')}}">
                      @error('stock_quantity')
                      <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <br>
                  <div class="form-group row">
                    <label for="tags" class="col-sm-2 col-form-label">Tags</label>
                    <div class="col-sm-10">
                      <select class="form-select" aria-label="Default select example" name="tags" value="{{old('tags')}}">
                        <option selected>Please select ...</option>
                        <option value="Drink">Drink</option>
                        <option value="Food">Food</option>
                        <option value="Snack">Snack</option>
                        <option value="Toy">Toy</option>
                        <option value="Stanionery">Stanionery</option>
                      </select>
                    </div>
                    {{-- <div class="col-sm-10">
                                <input type="text" class="form-control" name="tags" id="tags" value="{{old('tags')}}">
                    @error('tags')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                  </div> --}}
              </div>
              <br>
              <div class="form-group row">
                <label for="stock_image" class="col-sm-2 col-form-label">Stock Image</label>
                <div class="col-sm-10">
                  <input type="file" class="form-  " name="stock_image" id="stock_image" />
                  @error('stock_image')
                  <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                  @enderror
                </div>
              </div>
              <br>
              <div class="form-group row">
                <label for="stock_description" class="col-sm-2 col-form-label">Stock Description</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="stock_description" id="stock_description" rows="10">{{old('stock_description')}}</textarea>
                  @error('stock_description')
                  <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                  @enderror
                </div>
              </div>
              <br>
              <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-dark">
                  Create Stock
                </button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div><!-- End Extra Large Modal-->
      <!-- Table with hoverable rows -->
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Item Image</th>
            <th scope="col">Item Name</th>
            <th scope="col">Item Category</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @unless(count($listings) == 0)
          @foreach($listings as $listing)
          {{-- <h2> <a href="/listings/{{$listing['id']}}"> {{$listing['title']}} </a></h2>
          <p> {{$listing['description'] }}</p> --}}
          <tr>
            <th scope="row">{{$x++}}</th>
            <td><img src="{{$listing->stock_image ? asset('storage/' . $listing->stock_image) : asset("https://dummyimage.com/450x300/dee2e6/6c757d.jpg")}}" style="height: 150px; width: 100px;" /></td>
            <td>{{ $listing->stock_name }}</td>
            <td>{{ $listing->tags }}</td>
            <td>{{ $listing->stock_price }}</td>
            <td>{{ $listing->stock_quantity }}</td>
            <td>
              <br>
              <form action="/listings/{{$listing->stock_id}}/edit">
                <button class="btn btn-primary btn-sm"><i class="fa-solid fa-trash"></i>Edit</button>
              </form>
              <br>
              <form method="POST" action="/listings/{{$listing->stock_id}}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i>Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
          @else
          <p>No listings found</p>
          @endunless
        </tbody>
      </table>
      <!-- End Table with hoverable rows -->
      <div class="d-flex justify-content-center">
        {{$listings->links()}}
      </div>
    </div>
    </div>



  </main>
</x-adminLayout>