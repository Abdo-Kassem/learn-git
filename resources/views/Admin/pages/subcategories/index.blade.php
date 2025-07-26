@extends('Admin.layouts.master')

@php $lang = app()->getLocale(); @endphp

@section('pageTitle') <i class="fa fa-th" aria-hidden="true"></i> {{ trans('backend.subcategories') }} @endsection

@section('content')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title" style="padding:10px">
                {{ trans('backend.info') }} {{ trans('backend.subcategories') }}
            </h3>
            
            <div class="button-page-header">
                <a class="btn btn-block btn-primary" href="{{ route('subcategories.create') }}">
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
                            <th><b>{{ trans('backend.color') }}</b></th>
                            <th><b>{{ trans('backend.category') }}</b></th>
                            <th><b>{{ trans('backend.date') }}</b></th>
                            <th width="8%"><b>{{ trans('backend.manage') }}</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $subcategories as $index => $subcategory )
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><img style='width:70px' src="{{ asset($subcategory->image) }}"></td>
                                <td>{{ $lang =='ar' ? $subcategory->name_ar : $subcategory->name_fr }}</td>
                                <td><span style="padding:5px 30px; background-color:{{ $subcategory->color }}"></span></td>
                                <td>{{ $lang =='ar' ? $subcategory->category->name_ar : $subcategory->category->name_fr }}</td>
                                <td>{{ $subcategory->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group manage-button" title="View Account">
                                        <a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-cog"></i> <span class="caret"></span>
                                        </a>
                                        <ul role="menu" class="dropdown-menu dropdown-light pull-right">
                                            <li>
                                                <a title="{{ trans('backend.show') }} {{ trans('backend.record') }}" href="{{ route('subcategories.show' , $subcategory->id) }}">
                                                    <i class="fa fa-fw fa-eye"></i> {{ trans('backend.show') }}
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a title="{{ trans('backend.edit') }} {{ trans('backend.record') }}" href="{{ route('subcategories.edit' , $subcategory->id) }}">
                                                    <i class="fa fa-fw fa-pencil"></i> {{ trans('backend.edit') }}
                                                </a>
                                            </li>
                                        
                                            <li>
                                                <form action="{{ route('subcategories.destroy' , $subcategory->id) }}" method="POST" style="display:inline">
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