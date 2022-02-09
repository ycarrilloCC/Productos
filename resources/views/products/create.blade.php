<div class="row" id="principal_modal">
    <div class="col-md-12">
        <div class="modal-header">
            <h5 class="modal-title"><i class="fas fa-bus"></i>  {{__('Create Product')}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {{ Form::open(['route'=>'products.store','id'=>'frmProduct', 'class'=>'form', 'autocomplete'=>'Off']) }}
        <div class="modal-body">
            <div class="row m-3">
                <div class="col-xs-12 col-sm-12 col-md-12 mb-4 p-0">
                    <div class='form-group floating-label'>
                        {{ Form::text('name_product', null, ['class' => 'form-control text-uppercase', 'id'=> 'name_product', 'placeholder' => __('Product Name')])}}
                         {{Form::label('name_product', __('Product Name'), ['class' => 'title'])}}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-4 p-0">
                    <div class='form-group floating-label'>
                        {{ Form::number('product_price', null, ['class' => 'form-control numeric', 'id'=> 'product_price', 'placeholder' => __('Price')])}}
                         {{Form::label('product_price', __('Price'), ['class' => 'title'])}}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-4 p-0">
                    <div class='form-group floating-label'>
                        {{ Form::number('product_tax', null, ['class' => 'form-control numeric', 'id'=> 'product_tax', 'placeholder' => __('Tax %')])}}
                         {{Form::label('product_tax', __('Tax %'), ['class' => 'title'])}}
                    </div>
                </div>
                <div class="col-5 mx-auto">
                    {{ Form::button('<i class="far fa-save"></i> '.__('Save'), ['class' => 'btn btn-primary style', 'id' => 'save']) }}
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
<script type="text/javascript">
$(document).ready(function (){
    $('#save').on('click', function(){
        $.post("store", $('#frmProduct').serialize(), function(data){
            if(data.status == 1){
                $.get("loadproducts", function(data){
                    load_table_products(data);
                },'json').done(function() {
                    $('#remoteModal').modal('toggle');
                });
            }
            toastr[data.type](data.message, data.tittle,{
                "progressBar": true,
                "onclick": null,
                "positionClass": "toast-bottom-center"
            });
        },'json');
    });
});
</script>
