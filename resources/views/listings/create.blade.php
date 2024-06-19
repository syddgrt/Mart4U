<x-layout>
    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Create a new stock
        </h2>
    </header>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <form method="POST" action="/listings" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group row">
                      <label for="stock_name" class="col-sm-2 col-form-label">Stock Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="staticEmail" name="stock_name"
                        value="{{old('stock_name')}}">
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
                        <input type="text" class="form-control" name="tags" id="tags" value="{{old('tags')}}">
                        @error('tags')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                      </div>
                    </div>
                    <br>
                    <div class="form-group row">
                      <label for="stock_image" class="col-sm-2 col-form-label">Stock Image</label>
                      <div class="col-sm-10">
                        <input
                            type="file"
                            class="form-  "
                            name="stock_image"
                            id="stock_image"
                        />
                        @error('stock_image')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                      </div>
                    </div>
                    <br>
                    <div class="form-group row">
                      <label for="stock_description" class="col-sm-2 col-form-label">Stock Description</label>
                      <div class="col-sm-10">
                        <textarea
                            class="form-control"
                            name="stock_description"
                            id="stock_description"
                            rows="10"
                        >{{old('stock_description')}}</textarea>
                        @error('stock_description')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                      </div>
                    </div>
                    <br>
                    <div class=" row justify-content-center">
                        <button type="submit" class="btn btn-dark">
                            Create Stock
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <a href="/" class="text-black ml-4"> Back </a>
</x-layout>

