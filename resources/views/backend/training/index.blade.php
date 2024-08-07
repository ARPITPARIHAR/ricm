@extends('backend.layouts.app')
@section('meta_title', __('Slider'))

@section('page_name', __('Trainings'))

@section('page_description', __('Trainings'))
@section('name')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"> <i class="feather icon-home"></i> </a>
    </li>
    <li class="breadcrumb-item"><a href="#!">{{ __('Trainings') }}</a></li>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <!-- Zero config.table start -->
        <div class="card">
            <div class="card-header row">
                <div class="col-sm-2">
                    <a href="{{ route('training.create') }}" class="btn btn-sm btn-primary">{{ __('Add Training') }}</a>
                </div>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Hyperlink') }}</th> <!-- New Column Header -->
                                <th>{{ __('Updated At') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trainings as $key=>$training)
                            <tr>
                                <td>{{ ($key+1) + ($trainings->currentPage() - 1)*$trainings->perPage() }}</td>

                                <td><img src="{{ asset($training->thumbnail_img) }}" width="150"></td>

                                <td>
                                    @if($training->hyperlink)
                                        <a href="{{ $training->hyperlink }}" target="_blank">{{ __('View Link') }}</a>
                                    @else
                                        {{ __('No Link') }}
                                    @endif
                                </td>

                                <td>{{ date('d-m-Y h:iA', strtotime($training->updated_at)) }}</td>
                                <td>
                                    <a href="{{ route('training.edit', encrypt($training->id)) }}" class="btn btn-sm btn-primary">{{ __('Edit') }}</a>
                                    <a href="{{ route('training.delete', encrypt($training->id)) }}" class="btn btn-sm btn-danger">{{ __('Delete') }}</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Hyperlink') }}</th> <!-- New Column Footer -->
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
                            {{ $trainings->appends(request()->input())->links() }}
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
