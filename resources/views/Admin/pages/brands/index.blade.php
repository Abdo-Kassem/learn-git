@extends('Admin.layouts.master')

@section('pageTitle') <i class="fa fa-bookmark" aria-hidden="true"></i> {{ trans('backend.brands') }} @endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title" style="padding:10px">
                {{ trans('backend.info') }} {{ trans('backend.brands') }}
            </h3>

            <div class="button-page-header">
                <a class="btn btn-block btn-primary" href="{{ route('admin.brands.create') }}">
                <i class="fa fa-plus-circle fa-fw fa-lg"></i> {{ trans('backend.create_new') }}</a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="yajra-datatable" class="table table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><b>{{ trans('backend.logo') }}</b></th>
                            <th><b>{{ trans('backend.name') }}</b></th>
                            <th><b>{{ trans('backend.date') }}</b></th>
                            <th width="8%"><b>{{ trans('backend.manage') }}</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $brands as $index=>$category )
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><img style='width:70px' src="{{ asset($category->logo) }}"></td>
                                <td>{{ app()->getLocale()=='ar' ? $category->name_ar : $category->name_fr }}</td>
                                <td>{{ $category->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group manage-button" title="View Account">
                                        <a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-cog"></i> <span class="caret"></span>
                                        </a>
                                        <ul role="menu" class="dropdown-menu dropdown-light pull-right">
                                            <li>
                                                <a title="{{ trans('backend.edit') }} {{ trans('backend.record') }}" href="{{ route('admin.brands.edit' , $category->id) }}">
                                                    <i class="fa fa-fw fa-pencil"></i> {{ trans('backend.edit') }}
                                                </a>
                                            </li>
                                        
                                            <li>
                                                <form action="{{ route('admin.brands.destroy' , $category->id) }}" method="POST" style="display:inline">
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