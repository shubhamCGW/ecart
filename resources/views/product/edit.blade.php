@extends('layouts.admin')
@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">UPDATE PRODUCT</h4>

                <form method="post" action="{{ route('product.update',$product->id) }}" enctype="multipart/form-data">
                    <div class="form-group">
                        @csrf
                        @method('PATCH')
                        <label for="name">Product Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Product Name" value="{{ $product->name }}">
                        @error('name')
                        <span class="invalid-feedback"  role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div id="thumb-output"></div><br>
                    </div>
                    <div class="form-group">
                        <label for="price">Product Price</label>
                        <input type="text" name="price" class="form-control" placeholder="Enter Product Price" value="{{ $product->price }}">
                        @error('price')
                        <span class="invalid-feedback"  role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div id="thumb-output"></div><br>
                    </div>
                    <div class="form-group">
                        <label for="sub_desc">Product Sub Description</label>
                        <input type="text" name="sub_desc" class="form-control" placeholder="Enter Product Sub description" value="{{ $product->sub_desc }}">
                        @error('sub_desc')
                        <span class="invalid-feedback"  role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div id="thumb-output"></div><br>
                    </div>
                    <div class="form-group">
                        <label for="description">Product Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ $product->description }}</textarea>
                        @error('description')
                        <span class="invalid-feedback"  role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div id="thumb-output"></div><br>
                    </div>

                    <div class="form-group">
                        <img src="{{ $product->image }}" width="200" height="200">
                        <input type="file" name="image" class="form-control" value="{{ $product->image }}">
                        <label for="image">Upload Product Image</label>
                        @error('image')
                        <span class="invalid-feedback"  role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div id="thumb-output"></div><br>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Select Product Category</label>

                        <select name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $product->category_id }}"
                                @if ($product->category_id == old('category_id', $category->id))
                                    selected="selected"
                                @endif
                                >{{ $category->name }}</option>
                            @endforeach
                            </select>
                            @error('category_id')
                            <span class="invalid-feedback"  role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div id="thumb-output"></div><br>
                    </div>



                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>

@endsection
