<div class="row" id="principal_modal">
    <div class="col-md-12">
        <div class="modal-header">
            <h5 class="modal-title"><i class="fas fa-file-pd"></i>  {{__('Bill Detail')}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row m-3">
                <div class="col-xs-12 col-sm-12 col-md-12 mb-4 p-0">
                    <div class='form-group floating-label'>
                        {{ Form::text('user_name', $DetailBill[0]['user_name'], ['class' => 'form-control text-uppercase alphanum', 'id'=> 'user_name','disabled' => 'disabled', 'placeholder' => __('User Email')])}}
                         {{Form::label('user_name', __('User Email'), ['class' => 'title'])}}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-4 p-0">
                    <div class='form-group floating-label'>
                        {{ Form::number('totalPrice', $DetailBill[0]['totalPrice'], ['class' => 'form-control number', 'id'=> 'totalPrice','disabled' => 'disabled', 'placeholder' => __('Total Amount')])}}
                         {{Form::label('totalPrice', __('Total Amount'), ['class' => 'title'])}}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-4 p-0">
                    <div class='form-group floating-label'>
                        {{ Form::text('totalTax', $DetailBill[0]['totalTax'], ['class' => 'form-control text-uppercase', 'id'=> 'totalTax', 'disabled' => 'disabled', 'placeholder' => __('Total Taxes')])}}
                         {{Form::label('totalTax', __('Total Taxes'), ['class' => 'title'])}}
                    </div>
                </div>
            </div>
            <div class="content-table-style">
                <table class="table table-striped ll table-hover" id="table_products">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('Products') }}</th>
                            <th scope="col">{{ __('Price') }}</th>
                            <th scope="col">{{ __('Tax %') }}</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function (){
    var products = @json($DetailBill[0]['shopping']);
    load_table_products(products);
});
function load_table_products(value)
{
    $("#table_products").DataTable({
        processing  : false,
        ordering    : true,
        searching   : false,
        select      : false,
        destroy     : true,
        responsive  : true,
        bInfo       : false,
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
        {data:'product_tax', searchable: true, visible: true, className:'text-center', defaultContent:null}
        ]
    });
}
</script>
