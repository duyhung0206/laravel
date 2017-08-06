<link rel="stylesheet" href="{{url('/css/dataTables.bootstrap.min.css')}}">
<script src="{{ url ('/js/jquery-1.12.4.js') }}"></script>
<script src="{{ url ('/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url ('/js/dataTables.bootstrap.min.js') }}"></script>

@include('plugin.inputmask')

<script>
    $(function($) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        /*table list customer*/
        $('#example').DataTable();

        /*input phone number*/
        $('[data-mask]').inputmask();



    });

    var codeConfirm = '';

    $(document).ready(function() {
        var buttonDelete = null;
        $('#confirm-delete').on('shown.bs.modal', function(e) {
            buttonDelete = $(this).find('.btn-ok');
            buttonDelete.addClass("disabled");
            codeConfirm = Math.random().toString(36).replace(/[^a-z0-9]+/g, '').substr(0, 15);
            buttonDelete.attr('href', $(e.relatedTarget).data('href'));
            $('#name-customer-delete').text($(e.relatedTarget).data('name'));
            $('#code-verify').text(codeConfirm);
        });
        $("#inputCode").keyup(function() {
            if($('#inputCode').val() == codeConfirm){
                buttonDelete.removeClass("disabled");
            }else{
                buttonDelete.addClass("disabled");
            }
        });
    });

</script>
<style>
    table{
        font-size: 14px;
    }
    label{
        font-weight: 700 !important;
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

</style>