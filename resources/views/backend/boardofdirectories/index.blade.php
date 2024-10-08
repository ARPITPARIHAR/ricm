@extends('backend.layouts.app')
@section('meta_title',__('Board Of Directory'))

@section('page_name',__('Board Of Directory'))

@section('page_description',__('Board Of Directory'))
@section('name')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"> <i class="feather icon-home"></i> </a>
    </li>
    <li class="breadcrumb-item"><a href="#!">{{ __('Board Of Directory') }}</a>
    </li>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <!-- Zero config.table start -->
        <div class="card">
            <div class="card-header row">
                <div class="col-sm-2">
                    <a href="{{ route('boardofdirectories.create') }}" class="btn btn-sm btn-primary">{{ __('Add Board Directories') }}</a>
                </div>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Designation Title') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Thumbnail') }}</th>
                                <th>{{ __('Designation') }}</th>
                                <th>{{ __('Brief description') }}</th>

                                <th>{{ __('Updated At') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($boards as $key=>$board)
                            <tr>
                                <td>{{ ($key+1) + ($boards->currentPage() - 1)*$boards->perPage() }}</td>
                                <td>{{ $board->title }}</td>
                                <td>{{ $board->name }}</td>
                                <td><img src="{{ asset($board->thumbnail_img) }}" width="90"></td>
                                <td>{{ $board->designation }}</td>
                                <td>{{ $board->brief_description	 }}</td>

                                <td>{{ date('d-m-Y h:iA',strtotime($board->updated_at)) }}</td>
                                <td>
                                    <a href="{{ route('boardofdirectories.edit',encrypt($board->id)) }}" class="btn btn-sm btn-primary">{{ __('Edit') }}</a>
                                    <a href="{{ route('boardofdirectories.delete',encrypt($board->id)) }}" class="btn btn-sm btn-danger">{{ __('Delete') }}</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Designation Title') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Thumbnail') }}</th>
                                <th>{{ __('Designation') }}</th>
                                <th>{{ __('Brief description') }}</th>
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
                            {{ $boards->appends(request()->input())->links() }}
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
