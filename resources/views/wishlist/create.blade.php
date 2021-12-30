@extends('layouts.admin')
@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">ADD </h4>
                <form method="post" action="{{ route('wishlist.store') }}" enctype="multipart/form-data">

                    <div class="form-group">
                        @csrf
                        <label for="user_id">User Id</label>
                        <input type="number" name="user_id" class="form-control">
                        @error('user_id')
                        <span class="invalid-feedback"  role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div id="thumb-output"></div><br>
                    </div>
                    <div class="form-group">
                        <label for="product_id">Product ID</label>
                        <input type="text" name="product_id" class="form-control" placeholder="Enter Product id">
                    </div>
                    {{-- <div class="form-group">
                        <label for="price">Product Price</label>
                        <input type="text" name="price" class="form-control" placeholder="Enter Product Price">
                    </div> --}}
                    <div class="form-group">
                        <label for="price">Product Quantity</label>
                        <input type="text" name="quantity" class="form-control" placeholder="Enter Product Price">
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>

@endsection
