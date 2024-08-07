@extends('backend.layouts.app')

@section('meta_title', __('Events & Programmes'))

@section('page_name', __('Events & Programmes'))

@section('page_description', __('Events  & Programmes'))

@section('name')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"> <i class="feather icon-home"></i> </a>
    </li>
    <li class="breadcrumb-item"><a href="#!">{{ __('Events  & Programmes') }}</a></li>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header row">
                <div class="col-sm-2">
                    <a href="{{ route('upcoming.create') }}" class="btn btn-sm btn-primary">{{ __('Add Event & Programme') }}</a>
                </div>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('From Date | To Date') }}</th>
                                <th>{{ __('Venue') }}</th>
                                <th>{{ __('Know More') }}</th>
                                <th>{{ __('Updated At') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($upcoming as $key => $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->from_date }} | {{ $item->to_date }}</td>
                                <td>{{ $item->venue }}</td>
                                <td>
                                    <a href="#"><img src="{{ asset('images/pdf.png') }}" alt="pdf"></a>
                                </td>
                                <td>{{ date('d-m-Y h:iA', strtotime($item->updated_at)) }}</td>
                                <td>
                                    <a href="{{ route('upcoming.edit', encrypt($item->id)) }}" class="btn btn-sm btn-primary">{{ __('Edit') }}</a>
                                    <a href="{{ route('upcoming.delete', encrypt($item->id)) }}" class="btn btn-sm btn-danger">{{ __('Delete') }}</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('From Date | To Date') }}</th>
                                <th>{{ __('Venue') }}</th>
                                <th>{{ __('Know More') }}</th>
                                <th>{{ __('Updated At') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-5">
                        <div class="dataTables_info" id="simpletable_info" role="status" aria-live="polite">
                            Showing {{ $upcoming->firstItem() }} to {{ $upcoming->lastItem() }} of {{ $upcoming->total() }} entries
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-7">
                        <div class="float-sm-right">
                            {{ $upcoming->appends(request()->input())->links() }}
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

@endsection
