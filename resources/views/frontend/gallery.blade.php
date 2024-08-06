@extends('frontend.layouts.app')
@section('meta_title','Our Gallery | '.env('APP_NAME'))
@section('meta_description','Our Gallery | '.env('APP_NAME'))
@section('content')

<section class="gallery">
    <div class="container">
        <div class="row">
            <div class="head">
                <h2>Our Gallery</h2>
            </div>

            @foreach(\App\Models\Gallery::all() as $item)
                <div class="col-lg-3">
                    <a href="{{ route('gallery.detail', $item->slug) }}">
                        <div class="glry_box">
                            @php
                                $images = json_decode($item->image_paths);
                            @endphp
                            @if($images && count($images) > 0)
                                <div class="glry_imag">
                                    <img class="example-image" src="{{ asset($images[0]) }}" alt="{{ $item->title }}" />
                                </div>
                            @endif
                            <h4>{{ $item->title }}</h4>
                        </div>
                    </a>
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
