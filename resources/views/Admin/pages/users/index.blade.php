@extends('Admin.layouts.master')

@section('pageTitle') <i class="fa fa-users"></i> {{ trans('backend.users') }} @endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title" style="padding:10px">
                {{ trans('backend.info') }} {{ trans('backend.users') }}  
            </h3>
            
            <div class="button-page-header">
                <a class="btn btn-block btn-primary" href="{{ route('admin.users.create') }}">
                <i class="fa fa-plus-circle fa-fw fa-lg"></i> {{ trans('backend.create_new') }}</a>
            </div>
        </div>
        
        <div class="box-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><b>{{ trans('backend.image') }}</b></th>
                            <th><b>{{ trans('backend.name') }}</b></th>
                            <th><b>{{ trans('backend.email') }}</b></th>
                            <th><b>{{ trans('backend.phone') }}</b></th>
                            <th><b>{{ trans('backend.status') }}</b></th>
                            <th><b>{{ trans('backend.date') }}</b></th>
                            <th width="8%"><b>{{ trans('backend.manage') }}</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $users as $index=>$user )
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <img style="width:40px;height:35px" src="{{ asset($user->avatar) }}" alt="">
                                </td>
                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    @if( $user->status == 1 )
                                        <span class="badge label-success">{{ trans('backend.active') }}</span>
                                    @else
                                        <span class="badge label-danger">{{ trans('backend.inactive') }}</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group manage-button" title="View Account">
                                        <a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-cog"></i> <span class="caret"></span>
                                        </a>
                                        <ul role="menu" class="dropdown-menu dropdown-light pull-right">

                                            @if( $user->status == 0 )
                                                <li>
                                                    <a title="{{ trans('backend.activation') }} {{ trans('backend.record') }}" href="{{ route('admin.users.activation' , $user->id) }}">
                                                        <i class="fa fa-fw fa-check"></i> {{ trans('backend.activation') }}
                                                    </a>
                                                </li>
                                            @else
                                                <li>
                                                    <a title="{{ trans('backend.disable') }} {{ trans('backend.record') }}" href="{{ route('admin.users.activation' , $user->id) }}">
                                                        <i class="fa fa-fw fa-close"></i> {{ trans('backend.disable') }}
                                                    </a>
                                                </li>
                                            @endif

                                            @if($user->add_badge)
                                                <li>
                                                    <a title="{{ trans('backend.add') }} {{ trans('backend.badge') }}" href="{{ route('admin.users.show' , $user->id) }}" id="addBadgeButton" userid="{{ $user->id }}" currentbadge="{{ $user->badge }}">
                                                        <i class="fa fa-fw fa-plus"></i> {{ $user->badge == null ? trans('backend.add_badge') : trans('backend.edit_badge') }}
                                                    </a>
                                                </li>
                                            @endif

                                            <li>
                                                <a title="{{ trans('backend.show') }} {{ trans('backend.record') }}" href="{{ route('admin.users.show' , $user->id) }}">
                                                    <i class="fa fa-fw fa-eye"></i> {{ trans('backend.show') }}
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a title="{{ trans('backend.edit') }} {{ trans('backend.record') }}" href="{{ route('admin.users.edit' , $user->id) }}">
                                                    <i class="fa fa-fw fa-pencil"></i> {{ trans('backend.edit') }}
                                                </a>
                                            </li>
                                        
                                            <li>
                                                <form action="{{ route('admin.users.destroy' , $user->id) }}" method="POST" style="display:inline">
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

    <!-- edit badge Modal  -->
    <div class="modal fade" id="editBadgeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ trans('backend.add_badge') }}</h4>
                </div>
                <div class="modal-body">
                <form id="editImageForm" action="{{ route('admin.users.add-badge') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}

                    <input type="hidden" name="userId" id="userId">
                    
                        <div class="col-12">
                            <div class="form-group">
                                <label for="badge"><b>{{ trans('backend.select') }} {{ trans('backend.badge') }}</b></label>
                                <select name="badge" id="badge" class="form-control select2" style="width:100%">
                                    <option value="{{ App\Models\User::NEW }}">{{ trans('backend.seller_new') }}</option>
                                    <option value="{{ App\Models\User::ACTIVE }}">{{ trans('backend.seller_active') }}</option>
                                    <option value="{{ App\Models\User::FEATURED }}">{{ trans('backend.seller_featured') }}</option>
                                </select>
                                @if ($errors->has('badge'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('badge') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ trans('backend.close') }}</button>
                        <button type="submit" class="btn btn-success">{{ trans('backend.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            var table = $('#yajra-datatable').DataTable();

            $('#addBadgeButton').on('click', function(e) {
                e.preventDefault();
                $('#userId').val(e.target.getAttribute('userid'));
                $('#badge').val(e.target.getAttribute('currentbadge')).trigger('change');
                $('#editBadgeModal').modal('show');
            });
        });
    </script>
@endpush