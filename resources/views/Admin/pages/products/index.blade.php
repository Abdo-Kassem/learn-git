@extends('Admin.layouts.master')

@section('pageTitle') <i class="fa fa-shopping-bag"></i> {{ trans('backend.products') }} @endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title" style="padding:10px">
                {{ trans('backend.info') }} {{ trans('backend.products') }}
            </h3>
            
            <div class="button-page-header">
                <a class="btn btn-block btn-primary" href="{{ route('admin.products.create') }}">
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
                            <th><b>{{ trans('backend.price') }}</b></th>
                            <th><b>{{ trans('backend.type') }}</b></th>
                            <th><b>{{ trans('backend.status') }}</b></th>
                            <th><b>{{ trans('backend.delivery_type') }}</b></th>
                            <th><b>{{ trans('backend.date') }}</b></th>
                            <th width="8%"><b>{{ trans('backend.manage') }}</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $products as $index=>$product )
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <img style="width:50px;height:50px;object-fit:contain" src="{{ asset($product->image) }}" alt="">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    @if( $product->type == App\Models\Product::NEW )
                                        <span class="badge label-success">{{ trans('backend.new') }}</span>
                                    @else
                                        <span class="badge label-danger">{{ trans('backend.old') }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if( $product->status == 1 )
                                        <span class="badge label-success">{{ trans('backend.active') }}</span>
                                    @else
                                        <span class="badge label-danger">{{ trans('backend.sold') }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if( $product->delivery_type == 1 )
                                        <span class="badge label-primary">{{ trans('backend.delivery_in_place') }}</span>
                                    @else
                                        <span class="badge label-secondary">{{ trans('backend.avilable_shipping') }}</span>
                                    @endif
                                </td>
                                <td>{{ $product->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group manage-button" title="View Account">
                                        <a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-cog"></i> <span class="caret"></span>
                                        </a>
                                        <ul role="menu" class="dropdown-menu dropdown-light pull-right">

                                            @if( $product->status == 0 )
                                                <li>
                                                    <a title="{{ trans('backend.activation') }} {{ trans('backend.record') }}" href="{{ route('admin.products.activation' , $product->id) }}">
                                                        <i class="fa fa-fw fa-check"></i> {{ trans('backend.activation') }}
                                                    </a>
                                                </li>
                                            @else
                                                <li>
                                                    <a title="{{ trans('backend.sold') }} {{ trans('backend.record') }}" href="{{ route('admin.products.activation' , $product->id) }}">
                                                        <i class="fa fa-fw fa-close"></i> {{ trans('backend.sold') }}
                                                    </a>
                                                </li>
                                            @endif

                                            <li>
                                                <a title="{{ trans('backend.show') }} {{ trans('backend.record') }}" href="{{ route('admin.products.show' , $product->id) }}">
                                                    <i class="fa fa-fw fa-eye"></i> {{ trans('backend.show') }}
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a title="{{ trans('backend.edit') }} {{ trans('backend.record') }}" href="{{ route('admin.products.edit' , $product->id) }}">
                                                    <i class="fa fa-fw fa-pencil"></i> {{ trans('backend.edit') }}
                                                </a>
                                            </li>
                                        
                                            <li>
                                                <form action="{{ route('admin.products.destroy' , $product->id) }}" method="POST" style="display:inline">
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