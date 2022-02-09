@extends('layouts.default')
@section('content')
<div class="card">
    <div class="card-header">
        {{ __('Shopping') }}
    </div>
    {{ Form::open(['route'=>'products.store','id'=>'frmProduct', 'class'=>'form', 'autocomplete'=>'Off']) }}
    <div class="row pt-4 p-3">
        <div class="col-xs-12 col-sm-12 col-md-5">
            <div class="input-group">
                <div class="form-group floating-label">
                    {{Form::label('product', __('Product'), ['class' => 'selec2label'])}}
                    {{Form::select('product', $products , null, ['id'=>'product', 'class'=>'form-select','placeholder' => __('select...')])}}
               </div>
               <button class="btn btn-primary" type="button" id="buy"><i class="fas fa-shopping-cart"></i>{{ __('Buy') }}</button>
           </div>
        </div>
    </div>
    {{ Form::close() }}
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
@if(Session::has('msg'))
<script type="text/javascript">
    toastr["{{ Session::get('msg')['type'] }}"]("{{ Session::get('msg')['message'] }}", "{{ Session::get('msg')['tittle'] }}");
</script>
@endif
<script type="text/javascript">
$(document).ready(function () {
    var shopping = @json($shopping);
    load_table_products(shopping);
    $('#buy').on('click', function(){
        $.post("storeShopping", $('#frmProduct').serialize(), function(data){
            if(data.status == 1){
                $.get("loadshopping", function(data){
                    load_table_products(data);
                },'json')
            }
            toastr[data.type](data.message, data.tittle,{
                "progressBar": true,
                "onclick": null,
                "positionClass": "toast-bottom-center"
            });
        },'json');
    });
});
function load_table_products(value)
{
    $("#table_products").DataTable({
        processing  : false,
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
        {data:'product_name', searchable: true, visible: true, className:'text-center', defaultContent:null},
        {data:'product_price', searchable: true, visible: true, className:'text-center', defaultContent:null},
        {data:'product_tax', searchable: true, visible: true, className:'text-center', defaultContent:null},
        {
            data: null,
            searchable: false,
            className: "text-center",
            render: function (data, type, row) {
                var btn = "";
                    btn += ' <a  href="javascript:change_status('+ data.id +','+ 0 +');" class="btn btn-outline-primary btn-sm btn-icon" title="{{ __('Delete') }}" >\n' +
                    '                <i class="far fa-trash-alt"></i>\n' +
                    '            </a>';
                return btn;
            }
        }
        ]
    });
}
function change_status(id, type)
{
    $.get("deleteShopping/"+id, function (data){
        if(data.status == 1){
            $.get("loadshopping", function(data){
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