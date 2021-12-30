@extends('layouts.admin')
@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">ADD NEW CATEGORY</h4>
                <form method="post" action="{{ route('category.store') }}" enctype="multipart/form-data">

                    <div class="form-group">
                        @csrf
                        <label for="name">Category Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Product Name">
                    </div>
                    @if($errors->has('name'))
                                    <span class="error invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                    <div class="form-group">
                        <input type="file" name="image" class="form-control">
                        <label for="image">Upload Product Image</label>
                    </div>
                    @if($errors->has('image'))
                                    <span class="error invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                    @endif
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>

@endsection
