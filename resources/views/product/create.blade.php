@extends('layouts.admin')
@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">ADD NEW PRODUCT</h4>
                <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">

                    <div class="form-group">
                        @csrf
                        <label for="name">Product Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Product Name">
                    </div>
                    <div class="form-group">
                        <label for="price">Product Price</label>
                        <input type="text" name="price" class="form-control" placeholder="Enter Product Price">
                    </div>
                    <div class="form-group">
                        <label for="sub_desc">Product Sub Description</label>
                        <input type="text" name="sub_desc" class="form-control" placeholder="Enter Product Sub description">
                    </div>
                    <div class="form-group">
                        <label for="description">Product Description</label>
                        <textarea name="description" class="form-control ckeditor" rows="4"></textarea>
                    </div>

                    {{-- <div class="form-group">
                        <label for="description">Product Description</label>
                        <textarea class="form-control" name="description" id="summernote"></textarea>
                    </div> --}}

                    <div class="form-group">
                        <input type="file" name="image" class="form-control">
                        <label for="image">Upload Product Image</label>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Select Product Category</label>
                        <select name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                @if ($category->id == old('category', $category->id))
                                    selected="selected"
                                @endif
                                >{{ $category->name }}</option>
                            @endforeach
                            </select>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
        // $(document).ready(function () {
        //     $('#summernote').summernote({
        //     height: 400});
        // });



    </script>
@endsection
