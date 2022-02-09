@extends('layouts.default')
@section('content')
<div class="card">
    <div class="card-header">
        {{ __('Products') }}
    <a class="btn btn-primary float-end"  onClick="create()"> {{ __('New') }} </a>
    </div>
    <div class="content-table-style">
        <table class="table table-striped ll table-hover" id="table_products">
            <thead>
                <tr>
                    <th scope="col">{{ __('Products') }}</th>
                    <th scope="col">{{ __('Price') }}</th>
                    <th scope="col">{{ __('Tax %') }}</th>
                    <th scope="col">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<div class="modal fade modal-primary" id="remoteModal" tabindex="-1" role="dialog"
aria-labelledby="remoteModal" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content" id="principal_modal"></div>
</div>
</div>
@if(Session::has('msg'))
<script type="text/javascript">
    toastr["{{ Session::get('msg')['type'] }}"]("{{ Session::get('msg')['message'] }}", "{{ Session::get('msg')['tittle'] }}");
</script>
@endif
<script type="text/javascript">
$(document).ready(function () {
    var products = @json($products);
    load_table_products(products);
});
function load_table_products(value)
{
    $("#table_products").DataTable({
        processing  : true,
        ordering    : true,
        select      : false,
        destroy     : true,
        responsive  : true,
        data        : value,
        "order"     : [[0, 'asc']],
        "columnDefs": [
        {
          "defaultContent": "",
          "targets": '_all'
        }],
        columns: [
        {data:'name_product', searchable: true, visible: true, className:'text-center', defaultContent:null},
        {data:'product_price', searchable: true, visible: true, className:'text-center', defaultContent:null},
        {data:'product_tax', searchable: true, visible: true, className:'text-center', defaultContent:null},
        {
            data: null,
            searchable: false,
            className: "text-center",
            render: function (data, type, row) {
                var btn = "";

                if(data.status == 1){
                    btn += ' <a  href="javascript:edit('+"'"+ data.id +"'"+ ');" class="btn btn-outline-primary btn-sm btn-icon" title="{{ __('Edit') }}" >\n' +
                    '                <i class="far fa-edit"></i>\n' +
                    '            </a>';

                    btn += ' <a  href="javascript:change_status('+ data.id +','+ 0 +');" class="btn btn-outline-primary btn-sm btn-icon" title="{{ __('Delete') }}" >\n' +
                    '                <i class="far fa-trash-alt"></i>\n' +
                    '            </a>';
                }else{
                    btn += ' <a  href="javascript:change_status('+ data.id +','+ 1 +');" class="btn btn-outline-primary btn-sm btn-icon" title="{{ __('Active') }}" >\n' +
                    '                <i class="fas fa-history"></i>\n' +
                    '            </a>';
                }

                return btn;
            }
        }
        ]
    });
}
function create()
{
    $.get("create", function (data){
        $("#remoteModal .modal-content").html(data);
        $("#remoteModal").modal("show");
    },'html');
}
function edit(id)
{
    $.get("edit/"+id, function (data){
        $("#remoteModal .modal-content").html(data);
        $("#remoteModal").modal("show");
    },'html');
}
function change_status(id, type)
{
    $.get("change_status/"+id+'/'+type, function (data){
        if(data.status == 1){
            $.get("loadproducts", function(data){
                load_table_products(data);
            },'json');
        }
        toastr[data.type](data.message, data.tittle,{
            "progressBar": true,
            "onclick": null,
            "positionClass": "toast-bottom-center"
        });
    },'json');
}

</script>
@endsection