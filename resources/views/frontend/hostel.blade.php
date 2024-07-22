
@extends('frontend.layouts.app')
@section('meta_title','rcem')

@include('frontend.includes.navbar')

<div class="abt_instut">
    <h2>Hostel Facility</h2>
    @foreach (\App\Models\Hostelservice::all() as $hostelService)
    <p>{{ $hostelService->brief_description }}</p>
@endforeach

</div>
@include('frontend.includes.footer')




@section('style')

@endsection
@section('script')

@endsection
