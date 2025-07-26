@extends('Admin.layouts.master')

@php $lang = app()->getLocale() @endphp

@section('pageTitle') <i class="fa fa-th-large" aria-hidden="true"></i> {{ trans('backend.ratings') }} @endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title" style="padding:10px">
                {{ trans('backend.info') }} {{ trans('backend.ratings') }}
            </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="yajra-datatable" class="table table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><b>{{ trans('backend.user') }}</b></th>
                            <th><b>{{ trans('backend.seller') }}</b></th>
                            <th><b>{{ trans('backend.rating') }}</b></th>
                            <th><b>{{ trans('backend.date') }}</b></th>
                            <th width="8%"><b>{{ trans('backend.manage') }}</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $ratings as $index => $rating )
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <a href="{{ route('admin.users.show', $rating->user_id) }}">{{ $rating->user->first_name }} {{ $rating->user->last_name }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.show', $rating->seller_id) }}">{{ $rating->seller->first_name }} {{ $rating->seller->last_name }}</a>
                                </td>
                                <td>
                                    @for($counter = 0; $counter < $rating->rating_number; $counter++ )
                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                    @endfor
                                    @for($counter; $counter < 5; $counter++ )
                                        <i class="fa fa-star text-gray" aria-hidden="true"></i>
                                    @endfor    
                                </td>
                                <td>{{ $rating->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group manage-button" title="View Account">
                                        <a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-cog"></i> <span class="caret"></span>
                                        </a>
                                        <ul role="menu" class="dropdown-menu dropdown-light pull-right">

                                            <li>
                                                <a title="{{ trans('backend.show') }} {{ trans('backend.record') }}" href="{{ route('admin.ratings.show' , $rating->id) }}">
                                                    <i class="fa fa-fw fa-eye"></i> {{ trans('backend.show') }}
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.ratings.destroy' , $rating->id) }}" method="POST" style="display:inline">
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