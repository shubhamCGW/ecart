@extends('layouts.admin')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">YOUR BANNER</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    Image
                                </th>
                                {{-- <th>
                                    Name
                                </th> --}}
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banners as $banner)
                                <tr>
                                    {{-- <td>{{ $category->id }}</td> --}}
                                    {{-- <td>{{ $category->image }}</td> --}}
                                    {{-- <td>{{ $banner->image }}</td> --}}
                                    <td><img src="{{$banner->image }}" width="100" height="100"></td>
                                    <td class="text-center">
                                        <a href="{{ route('banner.edit', $banner->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action=" {{ route('banner.destroy', $banner->id) }}" method="post"
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
