@extends('index.layout')
@section('content')
<div class="row mb-4">
    <h2 class="col-6 tm-text-primary">
        Latest Photos
    </h2>
</div>
<div class="row tm-mb-90 tm-gallery">
    @foreach ($images as $img)
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
        <figure class="effect-ming tm-video-item">
            <img src="image/{{ $img->image }}" alt="Image" class="img-fluid">
            <figcaption class="d-flex align-items-center justify-content-center">
                <h2>{{$img->name}}</h2>
                <a href="{{ route('index.show',$img->id) }}">View more</a>
            </figcaption>
        </figure>
        <div class="d-flex justify-content-between tm-text-gray">
            <span class="tm-text-gray-light">{{$img->created_at}}</span>

        </div>
    </div>
    @endforeach
    {{ $images->render(); }}
</div> <!-- row -->


@endsection
