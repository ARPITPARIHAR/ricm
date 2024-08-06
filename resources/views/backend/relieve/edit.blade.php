@extends('backend.layouts.app')

@section('meta_title', __('Edit Reliving Order'))
@section('page_name', __('Edit Reliving Order'))
@section('page_description', __('Edit the details of the Reliving Order'))

@section('name')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"> <i class="feather icon-home"></i> </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('relieve.index') }}">{{ __('Reliving Orders') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ __('Edit Reliving Order') }}</li>
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
                <form action="{{ route('relieve.update', encrypt($relieve->id)) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">{{ __('Detail') }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" id="title" value="{{ old('title', $relieve->title) }}" placeholder="{{ __('Enter Detail') }}" class="form-control @error('title') form-control-danger @enderror">
                            <span class="messages">
                                @error('title')
                                    <p class="text-danger error">{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>
                    @if ($relieve->category_id)


                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">{{ __('Detail Category') }}</label>
                        <div class="col-sm-10">
                            <select name="category_id" id="category_id" class="form-control @error('category_id') form-control-danger @enderror">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if($relieve->category_id == $category->id) selected @endif>{{ $category->title }}</option>
                                @endforeach
                            </select>
                            <span class="messages">
                                @error('category_id')
                                    <p class="text-danger error">{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row" id="pdf">
                        <label class="col-sm-2 col-form-label">{{ __('PDF File') }}</label>
                        <div class="col-sm-10">
                            <input type="file" name="pdf_file" class="form-control @error('pdf_file') form-control-danger @enderror">
                            <span class="messages">
                                @error('pdf_file')
                                    <p class="text-danger error">{{ $message }}</p>
                                @enderror
                            </span>
                            @if($relieve->pdf_file)
                                <a href="{{ asset('storage/' . $relieve->pdf_file) }}" target="_blank">{{ __('View Current PDF') }}</a>
                            @endif
                        </div>
                    </div>
                    @endif
                    <div class="form-group row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-8">
                            <button type="submit" class="btn btn-primary float-sm-right">{{ __('Update') }}</button>
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
