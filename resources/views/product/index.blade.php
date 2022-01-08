@extends('layouts.admin')
@section('content')

    @if (!$products->isEmpty())
    <div class="row">
        <div class="col-lg-12 margin-tb">
            {{-- <div class="pull-right">
                <h2></h2>
            </div> --}}
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('product.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>
    @endif

    @if ($products->isEmpty())
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
                    <h4 class="card-title">YOUR PRODUCTS</h4>
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
                                    <th>
                                        Price(₹)
                                    </th>
                                    <th>
                                        Sub Desciption
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Category
                                    </th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td><img src="{{$product->image }}" width="100" height="100"></td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}₹</td>
                                        <td>{{ $product->sub_desc }}</td>
                                        {{-- <td>{{ substr(strip_tags($product->description), 0, 350) }}{{ strlen(strip_tags($product->description)) > 350 ? '...' : "" }} --}}
                                            {{-- <a href="#" >Read More</a></td> --}}
                                        {{-- {!! \Illuminate\Support\Str::markdown($product->description) !!} --}}
                                        <td>{{Str::limit( $product->description, 50)}}</td>
                                        <td>{{ $product->Category->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-pencil mx-0"></i></a>
                                            <a href="{{ route('product.show', $product->id) }}" class="btn btn-warning btn-sm"> <i class="mdi mdi-eye mx-0"></i> </a>
                                            <form action=" {{ route('product.destroy', $product->id) }}" method="post"
                                                style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type=" submit"><i class="mdi mdi-delete mx-0"></i></button>
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
