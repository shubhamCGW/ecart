@extends('layouts.admin')
@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">ADD NEW BANNER</h4>
                <form method="post" action="{{ route('banner.store') }}" enctype="multipart/form-data">

                    <div class="form-group">
                        @csrf
                        <label for="image">Upload Banner Image</label>
                        <input type="file" name="image" class="form-control">
                        @error('image')
                        <span class="invalid-feedback"  role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div id="thumb-output"></div><br>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>

@endsection
