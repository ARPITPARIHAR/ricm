@extends('backend.layouts.app')
@section('meta_title',__('Edit Gallery'))

@section('page_name',__('Edit Gallery'))

@section('page_description',__('Edit Gallery'))
@section('name')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"> <i class="feather icon-home"></i> </a>
    </li>
    <li class="breadcrumb-item"><a href="#!">{{ __('Edit Gallery') }}</a>
    </li>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <!-- Basic Form Inputs card start -->
        <div class="card">
            <div class="card-header">
                @if(session('success'))
                    <h5 class="text-success">{{ session('success') }}</h5>
                @else
                    <h5>@yield('page_name')</h5>
                @endif
            </div>
            <div class="card-block">
                <form action="{{ route('galleries.update', encrypt($detail->id)) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">{{ __('Thumbnail Image') }}</label>
                        <div class="col-sm-10">
                            <input type="file" name="thumbnail_img" id="thumbnail_img" class="form-control @error('thumbnail_img') form-control-danger @enderror">
                            @error('thumbnail_img')
                                <p class="text-danger error">{{ $message }}</p>
                            @else
                                <p class="text-muted">{{ __('') }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">{{ __('Title') }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" id="title" value="{{ old('title') ?? $detail->title }}" placeholder="{{ __('Enter Title') }}" class="form-control @error('title') form-control-danger @enderror">
                            @error('title')
                                <p class="text-danger error">{{ $message }}</p>
                            @else
                                <p class="text-muted">{{ __('') }}</p>
                            @enderror
                        </div>
                    </div>

                    <div id="image-fields">
                        @php
                            $images = json_decode($detail->image_paths);
                        @endphp
                        @if($images)
                            @foreach($images as $image)
                                <div class="form-group row image-field">
                                    <label class="col-sm-2 col-form-label">{{ __('Existing Image') }}</label>
                                    <div class="col-sm-8">
                                        <img src="{{ asset($image) }}" alt="{{ $detail->title }}" class="img-thumbnail" width="150">
                                        <input type="hidden" name="old_images[]" value="{{ $image }}">
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-danger remove-image">{{ __('Remove') }}</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="form-group row image-field">
                            <label class="col-sm-2 col-form-label">{{ __('Add New Images') }}</label>
                            <div class="col-sm-10">
                                <input type="file" name="images[]" class="form-control @error('images') form-control-danger @enderror">
                                @error('images')
                                    <p class="text-danger error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-8">
                            <button type="button" id="add-more" class="btn btn-secondary">{{ __('Add More') }}</button>
                            <button type="submit" class="btn btn-primary float-sm-right">{{ __('Save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')

@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('backend/plugins/i18next/js/i18next.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/plugins/i18next-xhr-backend/js/i18nextXHRBackend.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/plugins/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/plugins/jquery-i18next/js/jquery-i18next.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/plugins/summernote/summernote.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#description').summernote();

            // Add more image fields
            $('#add-more').click(function() {
                var newField = $('.image-field').last().clone();
                newField.find('input').val('');
                newField.appendTo('#image-fields');
            });

            // Remove existing image
            $(document).on('click', '.remove-image', function() {
                $(this).closest('.image-field').remove();
            });
        });
    </script>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote.css') }}">
@endsection
