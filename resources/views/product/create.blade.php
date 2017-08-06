@extends('adminlte::page')

@section('htmlheader_title')
	Change Title here!
@endsection

{{--header title--}}
@section('contentheader_title')
    Add new product
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-9 col-md-offset-1">

				<div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Info product</h3>
                        <div class="box-tools pull-right">
                            {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                            {{--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>--}}
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form class="form-horizontal" id="form-product" action="{{Asset('product/create')}}" method="post">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                            <div class="box-body">
                                <div class="form-group @if ($errors->has('name')) has-error @endif">
                                    <label for="name" class="col-sm-2 control-label">Name</label>

                                    <div class="input-group col-sm-10">
                                        <span class="input-group-addon">@</span>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Name" required="required">
                                    </div>
                                    <div class="col-sm-offset-2">
                                        @if ($errors->has('name'))<span class="help-block">{!!$errors->first('name')!!}</span>@endif
                                    </div>

                                <!-- /.input group -->

                                </div>
                                <div class="form-group @if ($errors->has('sku')) has-error @endif">
                                    <label for="sku" class="col-sm-2 control-label">Sku</label>

                                    <div class="input-group col-sm-10">
                                        <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                        <input type="text" id="sku" name="sku" class="form-control" placeholder="Sku" required="required">
                                    </div>
                                    <div class="col-sm-offset-2">
                                        @if ($errors->has('sku'))<span class="help-block">{!!$errors->first('sku')!!}</span>@endif
                                    </div>

                                    <!-- /.input group -->

                                </div>

                                <div class="form-group">
                                    <label for="supplier_id" class="col-sm-2 control-label">Minimal</label>
                                    <div class="input-group col-sm-10">
                                        <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                                        <select name="supplier_id" id="supplier_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                            <option value="0">Don't belong to any supplier</option>
                                            @foreach($suppliers as $supplier)
                                                <option value="{{$supplier->supplier_id}}">{{$supplier->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-offset-2">
                                        @if ($errors->has('supplier_id'))<span class="help-block">{!!$errors->first('supplier_id')!!}</span>@endif
                                    </div>
                                </div>

                                <div class="form-group @if ($errors->has('description')) has-error @endif">
                                    <label for="description" class="col-sm-2 control-label">Note</label>

                                    <div class="input-group col-sm-10">
                                        <span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
                                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description ..."></textarea>
                                    </div>
                                    <div class="col-sm-offset-2">
                                        @if ($errors->has('description'))<span class="help-block">{!!$errors->first('description')!!}</span>@endif
                                    </div>
                                <!-- /.input group -->

                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-warning col-sm-offset-2">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>

			</div>
		</div>
	</div>
@endsection

{{--script--}}
@include('product.scripts')
