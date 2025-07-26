@extends('Admin.layouts.master')

@php $lang = app()->getLocale() @endphp

@section('pageTitle') <i class="fa fa-money" aria-hidden="true"></i> {{ trans('backend.installation_subscriptions') }} @endsection

@section('content')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title" style="padding:10px">
                {{ trans('backend.info') }} {{ trans('backend.installation_subscriptions') }}
            </h3>
        </div>
       
        <div class="box-body">
            <div class="table-responsive">
                <table id="yajra-datatable" class="table table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><b>{{ trans('backend.product') }}</b></th>
                            <th><b>{{ trans('backend.package') }}</b></th>
                            <th><b>{{ trans('backend.start_at') }}</b></th>
                            <th><b>{{ trans('backend.end_at') }}</b></th>
                            <th><b>{{ trans('backend.is_expired') }}</b></th>
                            <th width="8%"><b>{{ trans('backend.manage') }}</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $subscriptions as $index => $subscription )
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <a href="{{ route('admin.products.show', $subscription->product_id) }}">{{ $lang == 'ar' ? $subscription->product->name_ar : $subscription->product->name_fr }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('packages.show', $subscription->package_id) }}">{{ $lang == 'ar' ? $subscription->package->name_ar : $subscription->package->name_fr }}</a>
                                </td>
                                <td>{{ Carbon\Carbon::parse($subscription->start_at)->format('Y-m-d') }}</td>
                                <td>{{ Carbon\Carbon::parse($subscription->end_at)->format('Y-m-d') }}</td>
                                <td>{{ $subscription->is_expired ? trans('backend.yes') : trans('backend.no') }}</td>
                                <td>
                                    <div class="btn-group manage-button" title="View Account">
                                        <a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-cog"></i> <span class="caret"></span>
                                        </a>
                                        <ul role="menu" class="dropdown-menu dropdown-light pull-right">
                                            <li>
                                                <form action="{{ route('admin.installation-subscriptions.destroy' , $subscription->id) }}" method="POST" style="display:inline">
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