@extends('Admin.layouts.master')

@php $lang = app()->getLocale() @endphp

@section('pageTitle') <i class="fa fa-flag" aria-hidden="true"></i> {{ trans('backend.complaints') }} @endsection

@section('content')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title" style="padding:10px">
                {{ trans('backend.info') }} {{ trans('backend.complaints') }}
            </h3>
        </div>
       
        <div class="box-body">
            <div class="table-responsive">
                <table id="yajra-datatable" class="table table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><b>{{ trans('backend.image') }}</b></th>
                            <th><b>{{ trans('backend.product') }}</b></th>
                            <th><b>{{ trans('backend.user') }}</b></th>
                            <th><b>{{ trans('backend.date') }}</b></th>
                            <th width="8%"><b>{{ trans('backend.manage') }}</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $complaints as $index => $complaint )
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><img src="{{ asset($complaint->product->image) }}" style="max-width:160px"></td>
                                <td>
                                    <a href="{{ route('admin.products.show', $complaint->product_id) }}">{{ $lang == 'ar' ? $complaint->product->name_ar : $complaint->product->name_fr }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.show', $complaint->user_id) }}">{{ $complaint->user->first_name }} {{ $complaint->user->last_name }}</a>
                                </td>
                                <td>{{ $complaint->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group manage-button" title="View Account">
                                        <a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-cog"></i> <span class="caret"></span>
                                        </a>
                                        <ul role="menu" class="dropdown-menu dropdown-light pull-right">
                                            <li>
                                                <form action="{{ route('admin.complaints.destroy' , $complaint->id) }}" method="POST" style="display:inline">
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