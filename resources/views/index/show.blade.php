@extends('index.layout')
@section('content')
<div class="row mb-4">
    <h2 class="col-12 tm-text-primary">{{$images->name}}</h2>
</div>
<div class="row tm-mb-90">
    <div class="col-xl-8 col-lg-7 col-md-6 col-sm-12">
        <img src="{{URL::to('/image/');}}/{{$images->image}}" alt="Image" class="img-fluid">
    </div>
    <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
        <div class="tm-bg-gray tm-video-details">
            <p class="mb-4">
                {{$images->detail}}
            </p>
            <div class="text-center mb-5">
                <a href="#" class="btn btn-primary tm-btn-big">${{$images->price}}</a>
            </div>
            <div class="mb-4">
                <h3 class="tm-text-gray-dark mb-3">License</h3>
                <p>Free for both personal and commercial use. No need to pay anything. No need to make any attribution.</p>
            </div>
            <div>
                <h3 class="tm-text-gray-dark mb-3">Tags</h3>
                @foreach ($tags as $tag)
                <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block">{{$tag}}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
