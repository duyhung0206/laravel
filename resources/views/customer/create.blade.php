@extends('adminlte::page')

@section('htmlheader_title')
	Change Title here!
@endsection

{{--header title--}}
@section('contentheader_title')
    Add new customer
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-9 col-md-offset-1">

				<div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Info customer</h3>
                        <div class="box-tools pull-right">
                            {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                            {{--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>--}}
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form class="form-horizontal" id="form-customer" action="{{Asset('customer/create')}}" method="post">
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
                                <div class="form-group @if ($errors->has('email')) has-error @endif">
                                    <label for="email" class="col-sm-2 control-label">Email</label>

                                    <div class="input-group col-sm-10">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="col-sm-offset-2">
                                        @if ($errors->has('email'))<span class="help-block">{!!$errors->first('email')!!}</span>@endif
                                    </div>
                                <!-- /.input group -->

                                </div>
                                <div class="form-group @if ($errors->has('phone')) has-error @endif">
                                    <label for="phone" class="col-sm-2 control-label">Phone number</label>

                                    <div class="input-group col-sm-10">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <input type="text" id="phone" name="phone" class="form-control" {{--data-inputmask="&quot;mask&quot;: &quot;99999-999-999&quot;" data-mask=""--}} placeholder="Phone number">
                                    </div>
                                    <div class="col-sm-offset-2">
                                        @if ($errors->has('phone'))<span class="help-block">{!!$errors->first('phone')!!}</span>@endif
                                    </div>
                                <!-- /.input group -->

                                </div>
                                <div class="form-group @if ($errors->has('address')) has-error @endif">
                                    <label for="address" class="col-sm-2 control-label">Address</label>

                                    <div class="input-group col-sm-10">
                                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                        <input type="text" id="address" name="address" class="form-control" placeholder="Address">
                                    </div>
                                    <div class="col-sm-offset-2">
                                        @if ($errors->has('address'))<span class="help-block">{!!$errors->first('address')!!}</span>@endif
                                    </div>
                                <!-- /.input group -->

                                </div>
                                <div class="form-group @if ($errors->has('note')) has-error @endif">
                                    <label for="note" class="col-sm-2 control-label">Note</label>

                                    <div class="input-group col-sm-10">
                                        <span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
                                        <textarea class="form-control" id="note" name="note" rows="3" placeholder="Note ..."></textarea>
                                    </div>
                                    <div class="col-sm-offset-2">
                                        @if ($errors->has('note'))<span class="help-block">{!!$errors->first('note')!!}</span>@endif
                                    </div>
                                <!-- /.input group -->

                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary col-sm-offset-2">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>

			</div>
		</div>
	</div>
@endsection

{{--script--}}
@include('customer.scripts')
