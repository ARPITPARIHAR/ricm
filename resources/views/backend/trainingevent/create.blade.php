@extends('backend.layouts.app')
@section('meta_title', __('Add Training'))

@section('page_name', __('Add Training'))

@section('page_description', __('Add Training'))

@section('name')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"> <i class="feather icon-home"></i> </a>
    </li>
    <li class="breadcrumb-item"><a href="#!">{{ __('Add Training') }}</a></li>
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
                <form action="{{ route('trainingevent.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">{{ __('Title') }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" id="title" value="{{ old('title')}}" placeholder="{{ __('Enter Title') }}" class="form-control @error('title') form-control-danger @enderror">
                            <span class="messages">
                                @error('title')
                                    <p class="text-danger error">{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">{{ __('Category') }}</label>
                        <div class="col-sm-10">
                            <select name="category_id" id="category_id" class="form-control @error('category_id') form-control-danger @enderror">
                                <option value="" >Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            <span class="messages">
                                @error('category_id')
                                    <p class="text-danger error">{{ $message }}</p>
                                @enderror
                            </span>
                            <p class="text-muted">{{ __("If you want to create a category, Don't select category.") }}</p>
                        </div>
                    </div>
                    <div class="form-group row" id="pdf">

                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-8">
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
        });
        $('#category_id').change(function() {
            if($('#category_id').val() == ""){
                $('#pdf').html('');
            } else{
                $('#pdf').html(`<label class="col-sm-2 col-form-label">{{ __('PDF File') }}</label>
                        <div class="col-sm-10">
                            <input type="file" name="pdf_file" class="form-control @error('pdf_file') form-control-danger @enderror">
                            <span class="messages">
                                @error('pdf_file')
                                    <p class="text-danger error">{{ $message }}</p>
                                @enderror
                            </span>
                        </div>`);
            }
        });
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote.css') }}">
@endsection
