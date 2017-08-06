@extends('adminlte::page')

@section('htmlheader_title')
	Change Title here!
@endsection

{{--header title--}}
@section('contentheader_title')
    Edit supplier
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
        <div class="row">
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
                @if (session('validate_error'))
                    <div class="callout callout-danger hideaftershow">
                        <h4>Error !</h4>
                        @if(count(session('validate_error')) > 0)
                            @foreach (session('validate_error') as $error)
                                <p>{{ $error[0] }}</p>
                            @endforeach
                        @endif
                    </div>
                @endif
        </div>
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-warning">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="http://iepec.com/trilhas/fnm/images/icone-tutoria.png" alt="User profile picture">

                        <h3 class="profile-username text-center">{{$supplier->name}}</h3>

                        <p class="text-muted text-center">{{$supplier->address}}</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Total order</b> <a class="pull-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Total amount</b> <a class="pull-right">543</a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-warning btn-block"><b>Follow</b></a>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">About Me</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

                        <p class="text-muted">
                            B.S. in Computer Science from the University of Tennessee at Knoxville
                        </p>

                        <hr>

                        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                        <p class="text-muted">Malibu, California</p>

                        <hr>

                        <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

                        <p>
                            <span class="label label-danger">UI Design</span>
                            <span class="label label-success">Coding</span>
                            <span class="label label-info">Javascript</span>
                            <span class="label label-warning">PHP</span>
                            <span class="label label-warning">Node.js</span>
                        </p>

                        <hr>

                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li @if (!session('tab_info') && !(session('tab_timeline'))) class="active" @endif><a href="#activity" data-toggle="tab">Order</a></li>
                        <li @if (session('tab_timeline')) class="active" @endif><a href="#timeline" data-toggle="tab">Report</a></li>
                        <li @if (session('tab_info')) class="active" @endif><a href="#info-supplier" data-toggle="tab">Info</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="@if (!session('tab_info') && !(session('tab_timeline'))) active @endif tab-pane" id="activity">
                            aaa
                            <!-- /.post -->
                        </div>
                        <!-- /.tab-pane -->
                        <div class="@if (session('tab_timeline')) active @endif tab-pane" id="timeline">
                          bbbb
                        </div>
                        <!-- /.tab-pane -->

                        <div class="@if (session('tab_info')) active @endif tab-pane" id="info-supplier">
                            <form class="form-horizontal" id="form-supplier" action="{{url('supplier/edit')}}" method="post">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                <input name="supplier_id" type="hidden" value="{{$supplier->supplier_id}}"/>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Name</label>

                                        <div class="input-group col-sm-10">
                                            <span class="input-group-addon">@</span>
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Name" required="required" value="{{$supplier->name}}">
                                        </div>
                                        <!-- /.input group -->

                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">Email</label>

                                        <div class="input-group col-sm-10">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{$supplier->email}}">
                                        </div>
                                        <!-- /.input group -->

                                    </div>

                                    <div class="form-group">
                                        <label for="representative" class="col-sm-2 control-label">Representative</label>

                                        <div class="input-group col-sm-10">
                                            <span class="input-group-addon"><i class="fa fa-street-view"></i></span>
                                            <input type="text" id="representative" name="representative" class="form-control" placeholder="Representative" value="{{$supplier->representative}}">
                                        </div>
                                        <!-- /.input group -->

                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="col-sm-2 control-label">Phone number</label>

                                        <div class="input-group col-sm-10">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone number" value="{{$supplier->phone}}">
                                        </div>
                                        <!-- /.input group -->

                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="col-sm-2 control-label">Address</label>

                                        <div class="input-group col-sm-10">
                                            <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                            <input type="text" id="address" name="address" class="form-control" placeholder="Address" value="{{$supplier->address}}">
                                        </div>
                                        <!-- /.input group -->

                                    </div>
                                    <div class="form-group">
                                        <label for="note" class="col-sm-2 control-label">Note</label>

                                        <div class="input-group col-sm-10">
                                            <span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
                                            <textarea class="form-control" id="note" name="note" rows="3" placeholder="Note ...">{{$supplier->note}}</textarea>
                                        </div>
                                        <!-- /.input group -->

                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" form="form-supplier" class="btn btn-warning">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
	</div>
@endsection

{{--script--}}
@include('supplier.scripts')