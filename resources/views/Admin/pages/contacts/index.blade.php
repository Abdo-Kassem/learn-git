@extends('Admin.layouts.master')

@section('pageTitle') <i class="fa fa-commenting" aria-hidden="true"></i> {{ trans('backend.contact') }} @endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title"style='margin: 10px 0'>
                {{ trans('backend.info') }} {{ trans('backend.contact') }} 
            </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="yajra-datatable" class="table table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><b>{{ trans('backend.name') }}</b></th>
                            <th><b>{{ trans('backend.email') }}</b></th>
                            <th><b>{{ trans('backend.phone') }}</b></th>
                            <th><b>{{ trans('backend.subject') }}</b></th>
                            <th><b>{{ trans('backend.date') }}</b></th>
                            <th width="8%"><b>{{ trans('backend.manage') }}</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $contacts as $index=>$contact )
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->subject }}</td>
                                <td>{{ $contact->created_at->diffForHumans() }}</td>
                                <td>
                                 
                                    <div class="btn-group manage-button" title="View Account">
                                        <a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-cog"></i> <span class="caret"></span>
                                        </a>
                                        <ul role="menu" class="dropdown-menu dropdown-light pull-right">
                                            <li>
                                                <a title="{{ trans('backend.show') }} {{ trans('backend.record') }}" href="{{ route('admin.pages.contacts.show' , $contact->id) }}">
                                                    <i class="fa fa-fw fa-eye"></i> {{ trans('backend.show') }}
                                                </a>
                                            </li>
   
                                            <li>
                                                <form action="{{ route('admin.pages.contacts.destroy' , $contact->id) }}" method="POST" style="display:inline">
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