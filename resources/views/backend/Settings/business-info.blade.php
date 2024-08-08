@extends('backend.layouts.app')

@section('meta_title',__('Business Info'))
@section('page_name',__('Business Info'))
@section('page_description',__('Business Info'))

@section('name')
    <li class="breadcrumb-item">
        {{-- <a href="{{ route('dashboard') }}"> <i class="feather icon-home"></i> </a> --}}
    </li>
    <li class="breadcrumb-item"><a href="#!">{{ __('Business Info') }}</a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <!-- Basic Form Inputs card start -->
            <div class="card">
                <div class="card-header">
                   @session('success')
                   <h5 class="text-success">{{ session('success') }}</h5>
                   @else
                    <h5>@yield('page_name')</h5>
                   @endsession
                </div>
                <div class="card-block">
                    <form action="{{ route('business-setting-update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">{{ __('Business Name') }}</label>
                            <div class="col-sm-10">
                                <input type="text" name="business_name" id="business_name" value="{{ old('business_name') ?? $business_info->business_name }}" placeholder="{{ __('Enter Business Name') }}" class="form-control @error('business_name') form-control-danger @enderror">
                               <span class="messages">
                                    @error('business_name')
                                        <p class="text-danger error">{{ $message }}</p>
                                    @else
                                        <p class="text-muted">{{ __('') }}</p>
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" id="email" value="{{ old('email') ?? $business_info->email }}" placeholder="{{ __('Enter Email') }}" class="form-control @error('email') form-control-danger @enderror">
                                @error('email')
                                    <p class="text-danger error">{{ $message }}</p>
                                @else
                                    <p class="text-muted">{{ __('') }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">{{ __('Contact Numbers') }}</label>
                            <div class="col-sm-10">
                                <input type="text" name="contact_numbers" id="contact_numbers" value="{{ old('contact_numbers') ?? $business_info->contact_numbers }}" placeholder="{{ __('Enter Contact Numbers') }}" class="form-control @error('contact_numbers') form-control-danger @enderror">
                                @error('contact_numbers')
                                    <p class="text-danger error">{{ $message }}</p>
                                @else
                                    <p class="text-muted">{{ __('') }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">{{ __('Address') }}</label>
                            <div class="col-sm-10">
                                <textarea name="address" id="address" placeholder="{{ __('Enter Address') }}" class="form-control @error('address') form-control-danger @enderror">{{ old('address') ?? $business_info->address }}</textarea>
                                @error('address')
                                    <p class="text-danger error">{{ $message }}</p>
                                @else
                                    <p class="text-muted">{{ __('') }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Header Logo</label>
                            <div class="col-sm-10">
                                <input type="file" name="header_logo" id="header_logo" class="form-control @error('header_logo') form-control-danger @enderror">
                                @error('header_logo')
                                    <p class="text-danger error">{{ $message }}</p>
                                @else
                                    <p class="text-muted">{{ __('') }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Footer Logo</label>
                            <div class="col-sm-10">
                                <input type="file" name="footer_logo" id="footer_logo" class="form-control @error('footer_logo') form-control-danger @enderror">
                                @error('footer_logo')
                                    <p class="text-danger error">{{ $message }}</p>
                                @else
                                    <p class="text-muted">{{ __('') }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Admin Logo</label>
                            <div class="col-sm-10">
                                <input type="file" name="admin_logo" id="admin_logo" class="form-control @error('admin_logo') form-control-danger @enderror">
                                @error('admin_logo')
                                    <p class="text-danger error">{{ $message }}</p>
                                @else
                                    <p class="text-muted">{{ __('') }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">{{ __('Instagram') }}</label>
                            <div class="col-sm-10">
                                <input type="text" name="instagram" id="instagram" value="{{ old('instagram') ?? $business_info->instagram }}" placeholder="{{ __('Enter Instagram') }}" class="form-control @error('instagram') form-control-danger @enderror">
                                @error('instagram')
                                    <p class="text-danger error">{{ $message }}</p>
                                @else
                                    <p class="text-muted">{{ __('') }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">{{ __('Linked In') }}</label>
                            <div class="col-sm-10">
                                <input type="text" name="linked_in" id="linked_in" value="{{ old('linked_in') ?? $business_info->linked_in }}" placeholder="{{ __('Enter Linked In') }}" class="form-control @error('linked_in') form-control-danger @enderror">
                                @error('linked_in')
                                    <p class="text-danger error">{{ $message }}</p>
                                @else
                                    <p class="text-muted">{{ __('') }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">{{ __('Facebook') }}</label>
                            <div class="col-sm-10">
                                <input type="text" name="facebook" id="facebook" value="{{ old('facebook') ?? $business_info->facebook }}" placeholder="{{ __('Enter Linked In') }}" class="form-control @error('facebook') form-control-danger @enderror">
                                @error('facebook')
                                    <p class="text-danger error">{{ $message }}</p>
                                @else
                                    <p class="text-muted">{{ __('') }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">{{ __('Twitter') }}</label>
                            <div class="col-sm-10">
                                <input type="text" name="twitter" id="twitter" value="{{ old('twitter') ?? $business_info->twitter }}" placeholder="{{ __('Enter Linked In') }}" class="form-control @error('twitter') form-control-danger @enderror">
                                @error('twitter')
                                    <p class="text-danger error">{{ $message }}</p>
                                @else
                                    <p class="text-muted">{{ __('') }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">{{ __('Youtube') }}</label>
                            <div class="col-sm-10">
                                <input type="text" name="youtube" id="youtube" value="{{ old('youtube') ?? $business_info->youtube }}" placeholder="{{ __('Enter Linked In') }}" class="form-control @error('youtube') form-control-danger @enderror">
                                @error('youtube')
                                    <p class="text-danger error">{{ $message }}</p>
                                @else
                                    <p class="text-muted">{{ __('') }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">{{ __('Brief Description') }}</label>
                            <div class="col-sm-10">
                                <textarea name="brief_description" id="brief_description" placeholder="{{ __('Enter Brief Description') }}" class="form-control @error('brief_description') form-control-danger @enderror">{{ old('brief_description') ?? $business_info->brief_description }}</textarea>
                                @error('brief_description')
                                    <p class="text-danger error">{{ $message }}</p>
                                @else
                                    <p class="text-muted">{{ __('') }}</p>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')

@endsection
@section('scripts')

@endsection
@section('styles')

@endsection
