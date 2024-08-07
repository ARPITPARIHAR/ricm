@extends('backend.layouts.app')
@section('meta_title',__('Galleries'))

@section('page_name',__('Galleries'))

@section('page_description',__('Galleries'))
@section('name')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"> <i class="feather icon-home"></i> </a>
    </li>
    <li class="breadcrumb-item"><a href="#!">{{ __('Galleries') }}</a>
    </li>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <!-- Zero config.table start -->
        <div class="card">
            <div class="card-header row">
                <div class="col-sm-2">
                    <a href="{{ route('galleries.create') }}" class="btn btn-sm btn-primary">{{ __('Add Gallery') }}</a>
                </div>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Images') }}</th>
                                <th>{{ __('Total Image') }}</th>
                                <th>{{ __('Title') }}</th>
                                 <th>{{ __('Updated At') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $key=>$detail)
                            <tr>
                                <td>{{ ($key+1) + ($details->currentPage() - 1)*$details->perPage() }}</td>
                                <td>
                                    @php
                                        $images = json_decode($detail->image_paths,true);
                                    @endphp
                                    <img src="{{ asset($images[0] ?? '') }}" width="100">
                                </td>
                                <td>
                                    {{ count($images) }}
                                </td>
                                <td>{{ $detail->title }}</td>
                                <td>{{ date('d-m-Y h:iA', strtotime($detail->updated_at)) }}</td>
                                <td>
                                    <a href="{{ route('galleries.edit',encrypt($detail->id)) }}" class="btn btn-sm btn-primary">{{ __('Edit') }}</a>
                                    <a href="{{ route('galleries.delete',encrypt($detail->id)) }}" class="btn btn-sm btn-danger">{{ __('Delete') }}</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Images') }}</th>
                                <th>{{ __('Total Image') }}</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Updated At') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-5">
                        <div class="dataTables_info" id="simpletable_info" role="status" aria-live="polite"></div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-7">
                        <div class="float-sm-right">
                            {{ $details->appends(request()->input())->links() }}
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
