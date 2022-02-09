<div class="row" id="principal_modal">
    <div class="col-md-12">
        <div class="modal-header">
            <h5 class="modal-title"><i class="fas fa-bus"></i>  {{__('Edit User')}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {{ Form::open(['route'=>'users.update','id'=>'frmUsers', 'class'=>'form', 'autocomplete'=>'Off']) }}
        {{ Form::hidden('id', $users->id, ['id'=> 'id'])}}
        <div class="modal-body">
            <div class="row m-3">
                <div class="col-xs-12 col-sm-12 col-md-12 mb-4 p-0">
                    <div class='form-group floating-label'>
                        {{ Form::text('name', $users->name, ['class' => 'form-control email', 'id'=> 'name', 'placeholder' => __('User Email')])}}
                         {{Form::label('name', __('User Email'), ['class' => 'title'])}}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-4 p-0">
                    <div class="input-group login-form">
                      <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                        {{ Form::password('password', ['class' => 'form-control eye min required',  "required"=>"required" , 'placeholder' => __('Password'), 'id'=> 'password'])}}
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
        $.post("updateUsers", $('#frmUsers').serialize(), function(data){
            if(data.status == 1){
                $.get("loadUsers", function(data){
                    load_table_users(data);
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
