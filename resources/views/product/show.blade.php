@extends('layouts.admin')
@section('content')

{{-- <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('category.create') }}"> Create New Product</a>
        </div>
    </div>
</div> --}}

{{-- <div class="row mt-4">
    <div class="col-lg-4 mb-3 mb-lg-0">
        <div class="card congratulation-bg text-center">
            <div class="card-body pb-0">
                <img src="{{ $product->image }}" alt="">
                <h2 class="mt-3 text-white mb-3 font-weight-bold">{{ $product->name }}
                </h2>
                <p>{{ $product->price }}</p> <p>{{ $product->sub_desc }}</p>
                <p>{{ $product->description }}</p>
            </div>
        </div>
    </div>
</div> --}}
<div class="col-lg-12 d-flex grid-margin stretch-card">
    <div class="card bg-primary">
        <div class="card-body text-white position_relative">
            <img src="{{ $product->image }}" alt="" style="height: 50, width:50">
            <h3 class="font-weight-bold mb-3">{{ $product->name }}</h3>
            {{-- <div class="progress mb-3">
                <div class="progress-bar  bg-warning" role="progressbar" style="width: 40%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div> --}}
            <p class="pb-0 mb-0">{{ $product->price }}</p> <br>
            <p class="pb-0 mb-0">{{ $product->sub_desc }}</p>
            <br>
            <p class="pb-0 mb-0">{{ $product->description }}</p>
        </div>
    </div>
</div>


@endsection
