<link rel="stylesheet" href="{{url('/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{url('/css/select2.min.css')}}">
<link rel="stylesheet" href="{{url('/css/iCheck/all.css')}}">


<script src="{{ url ('/js/jquery-1.12.4.js') }}"></script>

<script src="{{ url ('/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url ('/js/dataTables.bootstrap.min.js') }}"></script>

<script src="{{ url ('/js/select2.full.min.js') }}"></script>
<script src="{{ url ('/js/icheck.min.js') }}"></script>

@include('plugin.inputmask')

<script type="text/javascript">

    $(document).ready(function($) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /*table list customer*/
        var table = $('#product-order').DataTable({
            sort:false,
            searching:false,
            info:false,
            paging:false
        });

        /*Select 2*/
        $('.select2').select2();
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-red',
            radioClass   : 'iradio_flat-red'
        });

        $('#inputmaskdate').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });

        $("#paid").inputmask({
            alias: "currency",
            prefix: '',
            radixPoint: '.',
            placeholder: "0",
            autoGroup: !0,
            digits: 0,
            digitsOptional: !1,
            groupSepara: ',',
            groupSize: 3,
            repeat: 12,
            clearMaskOnLostFocus: !1
        });



        var indexTable = 0;
        $('#addNewRow').click(function () {
           addNewRow();
        });

        $('#product-order tbody').on( 'click', 'button.remove-row', function () {
            table
                .row( $(this).parents('tr') )
                .remove()
                .draw();
            calculationOrder();
        } );

        function addNewRow() {
            table.rows.add( [
                ['<input type="checkbox" name="product['+indexTable+'][return]" class="flat-red checkbox-refund">',
                    '<select name="product['+indexTable+'][name]" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required="required"></select>',
                    '<input type="text" name="product['+indexTable+'][qty]" value="0" class="form-control text-number" placeholder="Qty" required="required">',
                    '<input type="text" name="product['+indexTable+'][price]" value="0" class="form-control text-number" placeholder="Price" required="required">',
                    '<input type="text" name="product['+indexTable+'][rowtotal]" value="0" class="form-control text-number" placeholder="Row total" required="required">',
                    '<button type="button" class="btn btn-box-tool remove-row" style="padding: 0px; font-size: 20px;"><span class="glyphicon glyphicon-minus-sign"></span></button>']
            ] )
                .draw()
                .nodes()
                .to$()
                .addClass( 'new' );
            $("select[name='product["+indexTable+"][name]']").append($("#product_id > option").clone());
            $("select[name='product["+indexTable+"][name]']").select2();
            indexTable++;
            $('input[type="checkbox"].flat-red.checkbox-refund, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-red',
                radioClass   : 'iradio_flat-red'
            }).on('ifToggled', function () {
                $(this).closest('tr').toggleClass('is-refund');
                calculationOrder();
            });

            $('.text-number').inputmask({
                alias: "currency",
                prefix: '',
                radixPoint: '.',
                placeholder: "0",
                autoGroup: !0,
                digits: 0,
                digitsOptional: !1,
                groupSepara: ',',
                groupSize: 3,
                repeat: 11,
                clearMaskOnLostFocus: !1
            });
        }

        var indexTableFee = 0;
        $('#addFeeOrder').click(function () {
            var td1 = '<td class="col-md-5"><input type="text" name="fee['+indexTableFee+'][label]" class="form-control" required="required"></td>';
            var td2 = '<td class="col-md-5"><input type="text" name="fee['+indexTableFee+'][value]" class="form-control text-number" required="required" value="0"></td>';
            var td3 = '<td class="col-md-2"><button type="button" class="btn btn-box-tool remove-fee"><span class="glyphicon glyphicon-minus-sign"></span></button></td>';
            $('<tr>'+td1+td2+td3+'</tr>').insertAfter("#tableTotalOrder tbody tr:nth-child(2)");

            $('.text-number').inputmask({
                alias: "currency",
                prefix: '',
                radixPoint: '.',
                placeholder: "0",
                autoGroup: !0,
                digits: 0,
                digitsOptional: !1,
                groupSepara: ',',
                groupSize: 3,
                repeat: 11,
                clearMaskOnLostFocus: !1
            });
        });

        $('#tableTotalOrder tbody').on( 'click', 'button.remove-fee', function () {
            $(this).parents('tr').remove();
            calculationOrder();
        });

        $('#form-create-order').on( 'change', 'input.text-number', function () {
            var trindex = $(this).closest('td')[0].cellIndex;
            if(trindex == 4 || trindex== 2)
                return;
            calculationOrder();
        });

        $(document).on('click', '#product-order tbody tr td', function(e) {
            if(e.target.tagName.toLowerCase() == 'td'){
                var inputiCheck = $(this).closest('tr').find('input.checkbox-refund');
                if($(inputiCheck).prop("checked")){
                    $(inputiCheck).iCheck('uncheck');
                }else{
                    $(inputiCheck).iCheck('check');
                }
                calculationOrder();
            }
        });

        $(document).on('focus', 'input:text', function(e) {
            $(this).select();
        });

        $('#refund-all').on('ifChanged', function(e){
            $('input.checkbox-refund').each(function () {
                calculationOrder();
                if(e.currentTarget.checked){
                    $(this).iCheck('check');
                }else{
                    $(this).iCheck('uncheck');
                }

            });
        });

        $('#form-create-order').on( 'click', 'button#recalculation', function () {
            calculationOrder();
        });
        function calculationOrder() {
            var totalProduct = 0;
            var totalQty = 0;
            var totalAmount = 0;
            var totalRefund = 0;
            var totalBuy = 0;
            var subTotal = 0;
            var grandTotal = 0;

            var trs = $('#form-create-order #product-order tbody tr');
            if(trs.length >= 1 && $($(trs)[0]).find('td').length >3){
                trs.each(function () {
                    var tds = $(this).children('td');
                    var refund = $($(tds[0]).find('input')[0]).prop("checked");
                    var inputQty = $(tds[2]).find('input')[0];
                    var qty = parseFloat($(inputQty).val().replace(/,/g,''));
                    var inputPrice = $(tds[3]).find('input')[0];
                    var price = parseFloat($(inputPrice).val().replace(/,/g,''));
                    var inputRowtotal = $(tds[4]).find('input')[0];
                    var rowtotal = parseFloat($(inputRowtotal).val().replace(/,/g,''));

                    qty = isNaN(qty)?0:qty;
                    price = isNaN(price)?0:price;
                    rowtotal = isNaN(rowtotal)?0:rowtotal;
                    if((qty == 0 && price == 0) || (qty == 0 && rowtotal == 0) || (rowtotal == 0 && price == 0)){
                        $(inputQty).addClass('error-input');
                        $(inputPrice).addClass('error-input');
                        $(inputRowtotal).addClass('error-input');
                        return;
                    }else{
                        if(qty == 0){
                            qty = rowtotal/price;
                            $(inputQty).val(qty);
                        }
                        if(price == 0){
                            price = rowtotal/qty;
                            $(inputPrice).val(price);
                        }
//                        if(rowtotal == 0  || (qty != 0 && price != 0 && rowtotal != 0)){
                        if(rowtotal == 0  || (qty != 0 && price != 0 && rowtotal != 0)){
                            rowtotal = qty * price;
                            $(inputRowtotal).val(rowtotal);
                        }
                        if(refund){
                            rowtotal = -rowtotal;
                            totalRefund += rowtotal;
                        }else{
                            totalBuy += rowtotal;
                        }


                        totalProduct++;
                        totalQty += qty;
                        totalAmount += rowtotal;
                        $(inputQty).removeClass('error-input');
                        $(inputPrice).removeClass('error-input');
                        $(inputRowtotal).removeClass('error-input');
                    }
                });
            }
            subTotal = totalAmount;
            var fee = $('input[name^=fee].text-number');
            fee.each(function () {
                var feeValue = parseFloat($(this).val().replace(/,/g,''));
                feeValue = isNaN(feeValue)?0:feeValue;
                subTotal += feeValue;
            });
            var paid = parseFloat($('#paid').val().replace(/,/g,''));
            paid = isNaN(paid)?0:paid;
            grandTotal = subTotal - paid;
            $('#totalRefund').text(totalRefund.format());
            $('#totalBuy').text(totalBuy.format());
            $('#totalProduct').text(totalProduct.format());
            $('#totalQty').text(totalQty.format());
            $('#totalAmount').text(totalAmount.format());
            $('#subTotal').text(subTotal.format());
            $('#grandTotal').text(grandTotal.format());
        }

        Number.prototype.format = function(n, x) {
            var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
            return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
        };
        calculationOrder();
    });

</script>
<style>
    @media (min-width: 768px){
        .form-inline .form-control {
            width: 100% !important;
        }
    }
    .form-control{
        padding: 5px 6px !important;
    }
    table tbody tr td:first-child{
        vertical-align: middle;
    }
    table tbody tr td:last-child{
        text-align: center;
        vertical-align: middle;
    }

    table{
        font-size: 14px;
    }
    label{
        font-weight: 700 !important;
    }

    table thead th:first-child{
        width: 1%;
        white-space: nowrap;
        vertical-align: middle;
    }

    .hideaftershow {
        -moz-animation: cssAnimation 0s ease-in 5s forwards;
        /* Firefox */
        -webkit-animation: cssAnimation 0s ease-in 5s forwards;
        /* Safari and Chrome */
        -o-animation: cssAnimation 0s ease-in 5s forwards;
        /* Opera */
        animation: cssAnimation 0s ease-in 5s forwards;
        -webkit-animation-fill-mode: forwards;
        animation-fill-mode: forwards;
    }

    @keyframes cssAnimation {
        to {
            width:0;
            height:0;
            position: absolute;
            opacity: 0;
        }
    }
    @-webkit-keyframes cssAnimation {
        to {
            width:0;
            height:0;
            position: absolute;
            opacity: 0;
        }
    }

    .nav-tabs-custom > .nav-tabs > li.active {
        border-top-color: #f39c12 !important;
    }

    #tableTotalOrder tbody tr td{
        border:none;
    }
    #tableTotalOrder tbody tr td:nth-child(2){
        text-align: right;
    }
    #tableTotalOrder tbody tr td:nth-child(2) input{
        text-align: right;
    }
    .lineTop td:nth-child(2),.lineTop td:nth-child(1){
        border-top:2px solid #a0a0a0 !important;
    }

    #addFeeOrder, .remove-fee{
        padding: 3px !important;
        font-size: 20px !important;
    }

    .tab-pane{
        min-height: 400px;
    }

    .select2-container--default .select2-selection--single, .select2-selection .select2-selection--single{
        height: 36px !important;
    }

    .is-refund{
        background-color: lightgray;
    }

    #product-order tfoot tr th span{
        float: right;
    }

    .error-input{
        border-color: #a94442 !important;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075)  !important;
    }


</style>