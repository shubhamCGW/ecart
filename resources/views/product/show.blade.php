@extends('layouts.admin')
@section('content')
<div class="col-lg-12 d-flex grid-margin stretch-card">
    <div class="card bg-primary">
        <div class="card-body text-white position_relative">
            <img src="{{$product->image }}" width="100" height="100">
            <h3 class="font-weight-bold mb-3">{{ $product->name }}</h3>
            <p class="pb-0 mb-0">{{ $product->price }}</p> <br>
            <p class="pb-0 mb-0">{{ $product->sub_desc }}</p>
            <br>
            <p class="pb-0 mb-0">{!! \Illuminate\Support\Str::markdown($product->description) !!}</p>
        </div>
    </div>
</div>


@endsection
