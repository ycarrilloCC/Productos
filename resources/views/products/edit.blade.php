<div class="row" id="principal_modal">
    <div class="col-md-12">
        <div class="modal-header">
            <h5 class="modal-title"><i class="fas fa-bus"></i>  {{__('Edit Product')}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {{ Form::open(['route'=>'products.update','id'=>'frmProductEdit', 'class'=>'form', 'autocomplete'=>'Off']) }}
        {{ Form::hidden('id', $Products->id, ['id'=> 'id'])}}
        <div class="modal-body">
            <div class="row m-3">
                <div class="col-xs-12 col-sm-12 col-md-12 mb-4 p-0">
                    <div class='form-group floating-label'>
                        {{ Form::text('name_product', $Products->name_product, ['class' => 'form-control text-uppercase', 'id'=> 'name_product', 'placeholder' => __('Product Name')])}}
                         {{Form::label('name_product', __('Product Name'), ['class' => 'title'])}}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-4 p-0">
                    <div class='form-group floating-label'>
                        {{ Form::number('product_price', $Products->product_price, ['class' => 'form-control', 'id'=> 'product_price', 'placeholder' => __('Price')])}}
                         {{Form::label('product_price', __('Price'), ['class' => 'title'])}}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-4 p-0">
                    <div class='form-group floating-label'>
                        {{ Form::number('product_tax', $Products->product_tax, ['class' => 'form-control', 'id'=> 'product_tax', 'placeholder' => __('Tax %')])}}
                         {{Form::label('product_tax', __('Tax %'), ['class' => 'title'])}}
                    </div>
                </div>
                <div class="col-5 mx-auto">
                    {{ Form::button('<i class="far fa-save"></i> '.__('Update'), ['class' => 'btn btn-primary style', 'id' => 'update']) }}
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
<script type="text/javascript">
$(document).ready(function (){
    $('#update').on('click', function(){
        $.post("update", $('#frmProductEdit').serialize(), function(data){
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
