@extends('adminlte::page')

@section('htmlheader_title')
	Change Title here!
@endsection

{{--header title--}}
@section('contentheader_title')
	Manage product
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12 col-md-offset-0">
				<div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">List product</h3>
                        <div class="box-tools pull-right">
                            <a class="btn btn-warning btn-sm" href="{{ url('product/pagecreate') }}"><i class="fa fa-user-plus"></i> New Product</a>
                            {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if (session('notify'))
                        <div class="callout callout-success hideaftershow">
                            <h4>Success !</h4>
                            <p>{!! session('notify') !!}</p>
                        </div>
                        @endif
                        @if (session('notify_error'))
                            <div class="callout callout-danger hideaftershow">
                                <h4>Error !</h4>
                                <p>{!! session('notify_error') !!}</p>
                            </div>
                        @endif

                        <table id="example" class="table table-bordered table-hover dataTable" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Sku</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Sku</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->product_id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->sku}}</td>
                                    <td>{{$product->description}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-success btn-xs" href="{{url('product/pageedit',$product->product_id)}}">
                                            <span class="fa fa-edit"></span> Edit
                                        </a>
                                        <a data-name="{{$product->name}}" data-href="{{url('product/delete',$product->product_id)}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-xs">
                                            <span class="fa fa-remove"></span> Del
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>

			</div>
		</div>
	</div>

    <div class="modal fade modal-danger" id="confirm-delete" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Confirm</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete product <span id="name-product-delete" class="text-bold"></span></p>
                    <p>Code verify: <span id="code-verify" class="text-bold"></span></p>
                    <div class="form-group has-error">
                        <input type="text" class="form-control" id="inputCode" placeholder="Enter code to delete...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                    <a class="btn btn-outline btn-ok">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection

{{--script--}}
@include('product.scripts')
