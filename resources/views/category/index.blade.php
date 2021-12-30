@extends('layouts.admin')
@section('content')

@if (!$categories->isEmpty())
<div class="row">
    <div class="col-lg-12 margin-tb">
        {{-- <div class="pull-right">
            <h2></h2>
        </div> --}}
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('category.create') }}"> Create New Category</a>
        </div>
    </div>
</div>
@endif

@if ($categories->isEmpty())
    <div class="col-md-6">
        <p><a href="{{ route('product.create') }}" class="btn btn-success waves-effect waves-light">Add Product
            <i class="fa fa-plus"></i></a></p>
        <div class="alert alert-primary">
            <h4>There are no banner registrered yet.</h4>
            <p>You can add a banner by clicking on Add button.</p>

        </div>
    </div>
@else
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">YOUR CATEGORIES</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    Image
                                </th>
                                <th>
                                    Name
                                </th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    {{-- <td>{{ $category->id }}</td> --}}
                                    <td><img src="{{ $category->image }}" alt=""></td>
                                    <td><a href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a></td>
                                    <td class="text-center">
                                        {{-- <a href="{{ route('category.show', $category->id) }}" class="btn btn-warning btn-sm">Show</a> --}}
                                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action=" {{ route('category.destroy', $category->id) }}" method="post"
                                            style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type=" submit">Delete</button>
                                            </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
