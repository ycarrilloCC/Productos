@extends('layouts.default')
@section('content')
<div class="card">
    <div class="card-header">
        {{ __('Users') }}
    <a class="btn btn-primary float-end"  onClick="create()"> {{ __('New') }} </a>
    </div>
    <div class="content-table-style">
        <table class="table table-striped ll table-hover" id="table_users">
            <thead>
                <tr>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Type') }}</th>
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
    var users = @json($users);
    load_table_users(users);
});
function load_table_users(value)
{
    $("#table_users").DataTable({
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
        {data:'name', searchable: true, visible: true, className:'text-center', defaultContent:null},
        {
            data: null,
            searchable: false,
            className: "text-center",
            render: function (data, type, row) {
                var type = "";

                if(data.type == 1){
                    type = 'Administrator';
                }else{
                    type = 'Customer';
                }
                return type;
            }
        },
        {
            data: null,
            searchable: false,
            className: "text-center",
            render: function (data, type, row) {
                var btn = "";
                if({{Auth::user()->type}} == 1){
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
                }
                return btn;
            }
        }
        ]
    });
}
function create()
{
    $.get("createUser", function (data){
        $("#remoteModal .modal-content").html(data);
        applyFormats();
        $("#remoteModal").modal("show");
    },'html');
}
function edit(id)
{
    $.get("editUsers/"+id, function (data){
        $("#remoteModal .modal-content").html(data);
        applyFormats();
        $("#remoteModal").modal("show");
    },'html');
}
function change_status(id, type)
{
    $.get("changeStatusUsers/"+id+'/'+type, function (data){
        if(data.status == 1){
            $.get("loadproducts", function(data){
                load_table_users(data);
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