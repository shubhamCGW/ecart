@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('category.create') }}"> Create New Category</a>
        </div>
    </div>
</div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Product List of : {{ $category->name }}</h4>
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
                            @foreach ($products as $product)
                                <tr>
                                    {{-- <td>{{ $category->id }}</td> --}}
                                    <td><img src="{{ $product->image }}" alt=""></td>
                                    <td><a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a></td>
                                    <td class="text-center">
                                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action=" {{ route('product.destroy', $product->id) }}" method="post"
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

@endsection
