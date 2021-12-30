@extends('layouts.admin')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">UPDATE CATEGORY</h4>
                <form method="post" action="{{ route('category.update', $category->id) }}" enctype="multipart/form-data">

                    <div class="form-group">
                        @csrf
                        @method('PATCH')
                        <label for="name">Category Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Category Name"
                            value="{{ $category->name }}">
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <img src="{{ $category->image }}" style="height: 100,width:100">

                        <input type="file" class="form-control-file " id="file-input" name="image"
                            value="{{ $category->image }}">
                        <label for="image">Upload Category Image</label>
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div id="thumb-output"></div><br>
                    </div>
                    {{-- <div class="form-group">
                        <img src="{{ $category->image }}" style="height: 100,width:100">
                        <input type="file" name="image" class="form-control" value="{{ $category->image }}">
                        <label for="image">Upload Category Image</label>
                    </div>
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror --}}

                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>

@endsection


<script type="text/javascript">
    $(document).ready(function(){
     $('#file-input').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image element
                        $('#thumb-output').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
     });
    });
    </script>
