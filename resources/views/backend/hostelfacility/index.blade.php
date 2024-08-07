@extends('backend.layouts.app')
@section('meta_title', __('Hostel Facilities'))

@section('page_name', __('Hostel Facilities'))

@section('page_description', __('Hostel Facilities'))

@section('name')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"> <i class="feather icon-home"></i> </a>
    </li>
    <li class="breadcrumb-item"><a href="#!">{{ __('Hostel Facilities') }}</a></li>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <!-- Zero config.table start -->
        <div class="card">
            <div class="card-header row">
                <div class="col-sm-2">
                    <a href="{{ route('hostelfacility.create') }}" class="btn btn-sm btn-primary">{{ __('Add Hostel Facility') }}</a>
                </div>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Brief Description') }}</th>
                                <th>{{ __('Updated At') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hostels as $key => $hostel)
                            <tr>
                                <td>{{ ($key + 1) + ($hostels->currentPage() - 1) * $hostels->perPage() }}</td>
                                <td>
                                    <div class="brief-description">
                                        {{ $hostel->brief_description }}
                                    </div>
                                </td>
                                <td>{{ date('d-m-Y h:iA', strtotime($hostel->updated_at)) }}</td>
                                <td>
                                    <a href="{{ route('hostelfacility.edit', encrypt($hostel->id)) }}" class="btn btn-sm btn-primary">{{ __('Edit') }}</a>
                                    <a href="{{ route('hostelfacility.delete', encrypt($hostel->id)) }}" class="btn btn-sm btn-danger">{{ __('Delete') }}</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Brief Description') }}</th>
                                <th>{{ __('Updated At') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-5">
                        <div class="dataTables_info" id="simpletable_info" role="status" aria-live="polite">
                            Showing {{ $hostels->firstItem() }} to {{ $hostels->lastItem() }} of {{ $hostels->total() }} entries
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-7">
                        <div class="float-sm-right">
                            {{ $hostels->appends(request()->input())->links() }}
                        </div>
                    </div>
                </div>
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
<style>
    .brief-description {
        max-height: 3em; /* Limit to approximately 3 lines */
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
@endsection
