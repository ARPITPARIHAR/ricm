@extends('frontend.layouts.app')
@section('meta_title','Our Gallery | '.env('APP_NAME'))
@section('meta_description','Our Gallery | '.env('APP_NAME'))
@section('content')
<section class="gallery">
    <div class="container">
        <div class="row">
            <div class="head">
                <h2>{{ $gallery->title }}</h2>
            </div>
            @php
                $images = json_decode($gallery->image_paths);
            @endphp
            @foreach ($images as $image)
                <div class="col-lg-3">
                    <div class="glry_box">
                        <a class="example-image-link" href="{{ asset($image) }}" data-lightbox="example-set"><img class="example-image" src="{{ asset($image) }}" alt="{{ $gallery->title }}"/></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<script>
    // Initialize lightbox
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    });
</script>
@endsection
