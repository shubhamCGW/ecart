@extends('layouts.admin')
@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">UPDATE BANNER</h4>
                <form method="post" action="{{ route('category.update',$banner->id) }}">
                    <div class="form-group">
                        @csrf
                        @method('PATCH')
                        <label for="name">Upload Banner Image</label>
                        <input type="file" name="image" class="form-control" value="{{ $banner->image }}">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>

@endsection
