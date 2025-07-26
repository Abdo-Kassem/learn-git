@extends('Admin.layouts.master')

@section('pageTitle') <i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ trans('backend.packages') }} @endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title" style='padding:10px 0'>
                {{ trans('backend.info') }} {{ trans('backend.packages') }}
            </h3>
            
            <div class="button-page-header">
                <a class="btn btn-block btn-primary" href="{{ route('packages.create') }}">
                <i class="fa fa-plus-circle fa-fw fa-lg"></i> {{ trans('backend.create_new') }}</a>
            </div>
        </div>
    
        <div class="box-body">
            <div class="table-responsive">
                <table id="yajra-datatable" class="table table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><b>{{ trans('backend.image') }}</b></th>
                            <th><b>{{ trans('backend.name') }}</b></th>
                            <th><b>{{ trans('backend.days_number') }}</b></th>
                            <th><b>{{ trans('backend.price') }}</b></th>
                            <th><b>{{ trans('backend.category') }}</b></th>
                            <th><b>{{ trans('backend.date') }}</b></th>
                            <th width="8%"><b>{{ trans('backend.manage') }}</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $packages as $index => $package )
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <img style='width:50px' src="{{ asset($package->image) }}">
                                </td>
                                <td>{{ app()->getLocale() == 'ar' ? $package->name_ar : $package->name_fr }}</td>
                                <td>{{ $package->days_number }}</td>
                                <td>{{ $package->price }}</td>
                                <td>{{ app()->getLocale() == 'ar' ? $package->category->name_ar : $package->category->name_fr }}</td>
                                <td>{{ $package->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group manage-button" title="View Account">
                                        <a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-cog"></i> <span class="caret"></span>
                                        </a>
                                        <ul role="menu" class="dropdown-menu dropdown-light pull-right">
                                            <li>
                                                <a title="{{ trans('backend.show') }} {{ trans('backend.record') }}" href="{{ route('packages.show' , $package->id) }}">
                                                    <i class="fa fa-fw fa-eye"></i> {{ trans('backend.show') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a title="{{ trans('backend.edit') }} {{ trans('backend.record') }}" href="{{ route('packages.edit' , $package->id) }}">
                                                    <i class="fa fa-fw fa-pencil"></i> {{ trans('backend.edit') }}
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('packages.destroy' , $package->id) }}" method="POST" style="display:inline">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button title="{{ trans('backend.edit') }} {{ trans('backend.record') }}" type="submit"  class="delete" style="cursor:pointer">
                                                        <i class="fa fa-trash fa-fw"></i> {{ trans('backend.delete') }}
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

@endsection


@push('scripts')
    <script>
        $(document).ready(function(){
            var table = $('#yajra-datatable').DataTable();
        });
    </script>
@endpush