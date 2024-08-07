@extends('backend.layouts.app')
@section('meta_title',__('Other Useful Information'))

@section('page_name',__('Other Useful Information'))

@section('page_description',__('Other Useful Information'))
@section('name')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"> <i class="feather icon-home"></i> </a>
    </li>
    <li class="breadcrumb-item"><a href="#!">{{ __('Other Useful Information') }}</a>
    </li>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <!-- Zero config.table start -->
        <div class="card">
            <div class="card-header row">
                <div class="col-sm-2">
                    <a href="{{ route('information.create') }}" class="btn btn-sm btn-primary">{{ __('Add Other Useful Information') }}</a>
                </div>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Logo') }}</th>
                                <th>{{ __('Hyperlink') }}</th>
                                <th>{{ __('Updated At') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $key=>$client)
                            <tr>
                                <td>{{ ($key+1) + ($clients->currentPage() - 1)*$clients->perPage() }}</td>
                                <td>{{ $client->title }}</td>
                                <td><img src="{{ asset($client->logo) }}" width="90"></td>
                                <td>{{ $client->Hyperlink }}</td>
                                <td>{{ date('d-m-Y h:iA',strtotime($client->updated_at)) }}</td>
                                <td>
                                    <a href="{{ route('information.edit',encrypt($client->id)) }}" class="btn btn-sm btn-primary">{{ __('Edit') }}</a>
                                    <a href="{{ route('information.delete',encrypt($client->id)) }}" class="btn btn-sm btn-danger">{{ __('Delete') }}</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Logo') }}</th>
                                <th>{{ __('Hyperlink') }}</th>
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
                            {{ $clients->appends(request()->input())->links() }}
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
