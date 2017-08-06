@extends('adminlte::page')

@section('htmlheader_title')
	Change Title here!
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Setting</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li @if($type == 'season')class="active" @endif><a href="{{url('setting/season')}}" data-toggle="tab1"><i class="fa fa-inbox"></i> Inbox
                                    <span class="label label-primary pull-right">12</span></a></li>
                            <li @if($type == 'other')class="active" @endif><a href="{{url('setting/other')}}" data-toggle="tab2"><i class="fa fa-envelope-o"></i> Sent</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9 tab-content">
                @if($type == 'season')
                    @include('setting.season')
                @endif
                @if($type == 'other')
                    @include('setting.other')
                @endif
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
	</div>
@endsection
