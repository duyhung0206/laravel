@extends('adminlte::page')

@section('htmlheader_title')
    Change Title here!
@endsection


@section('main-content')
    <select data-select2-select="true" data-select2-validate="true" name="product_id" id="product_id" hidden required="required">
        <option value="">Chọn sản phẩm</option>
        @foreach($products as $product)
            <option value="{{$product->product_id}}" title="{{$product->sku}}">{{$product->name}} ({{$product->sku}})
            </option>
        @endforeach
    </select>
    <div class="container-fluid spark-screen">
        <form class="form-horizontal" id="form-create-order" action="{{Asset('order/create')}}" method="post">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <div class="row">
                <div class="col-md-8" style="padding-right:0px;">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Mặt hàng</a></li>
                            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Các order cũ</a></li>
                            <li class="pull-right" style="width: 66%;">
                                <div class="input-group col-md-3" style="float: left">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input id="inputmaskdate" type="text" class="form-control"
                                           data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" placeholder="dd/mm/yyyy" required="required">
                                </div>
                                <div class="input-group col-md-6 col-md-offset-1" style="float: left">
                                    <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                                    <select data-select2-select="true" data-select2-validate="true" name="customer_id" id="customer_id"
                                            class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                                            tabindex="-1" aria-hidden="true" required="required">
                                        <option value="">Chọn khách hàng</option>
                                        @foreach($customers as $customer)
                                            <option value="{{$customer->customer_id}}"
                                                    title="{{$customer->address}}">{{$customer->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button id="recalculation" style="height: 36px" type="button" class="btn btn-default btn-lrg ajax" title="Ajax Request">
                                        <i class="fa fa-spin fa-refresh"></i>
                                    </button>
                                </div>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <table class="table table-bordered table-hover" id="product-order">
                                    <thead>
                                    <tr>
                                        <th class="col-md-1"><input type="checkbox" id="refund-all"class="flat-red"></th>
                                        <th class="col-md-4">Tên hàng</th>
                                        <th class="col-md-2">Số lượng</th>
                                        <th class="col-md-2">Giá</th>
                                        <th class="col-md-2">Thành tiền</th>
                                        <th class="col-md-1" style="text-align: center;">
                                            <button type="button" id="addNewRow" class="btn btn-box-tool"
                                                    style="padding: 0px;font-size: 20px;"><span
                                                        class="glyphicon glyphicon-plus-sign"></span></button>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th></th>
                                        <th><span id="totalProduct">0</span></th>
                                        <th><span id="totalQty">0</span></th>
                                        <th></th>
                                        <th><span id="totalAmount">0</span></th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">

                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Thanh toán</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" id="addFeeOrder" class="btn btn-box-tool"
                                            title="Add new fee"><span class="glyphicon glyphicon-plus-sign"></span>
                                </div>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="tableTotalOrder" class="table table-responsive">
                                    <tbody>
                                    <tr>
                                        <td class="col-md-5">Hàng lấy</td>
                                        <td class="col-md-5" style="padding-right: 15px;"><span id="totalBuy"></span></td>
                                        <td class="col-md-2">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-5">Hàng trả</td>
                                        <td class="col-md-5" style="padding-right: 15px;"><span id="totalRefund"></span></td>
                                        <td class="col-md-2"></td>
                                    </tr>
                                    <tr class="lineTop">
                                        <td class="col-md-5">Tổng</td>
                                        <td class="col-md-5" style="padding-right: 15px;"><span id="subTotal"></span></td>
                                        <td class="col-md-2"></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-5">Thanh toán</td>
                                        <td class="col-md-5"><input type="text" id="paid" name="paid" class="form-control text-number"
                                                                    required="required"></td>
                                        <td class="col-md-2"></td>
                                    </tr>
                                    <tr class="lineTop">
                                        <td class="col-md-5">Còn nợ</td>
                                        <td class="col-md-5" style="padding-right: 15px;"><span id="grandTotal"></span></td>
                                        <td class="col-md-2"></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <div class="col-sm-offset-7">
                                        <button type="submit" form="form-create-order" class="btn btn-warning">Xác nhận</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
{{--@push('scripts')--}}

{{--@endpush--}}
@section('script-page')
    @include('order.scripts')
@endsection