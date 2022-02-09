@extends('layouts.default')
@section('content')
<div class="card">
    <div class="card-header">
        {{ __('Bills') }}
    <a class="btn btn-primary float-end"  onClick="check_in()"> {{ __('Generate Check In') }} </a>
    </div>
    <div class="content-table-style">
        <table class="table table-striped ll table-hover" id="table_bill">
            <thead>
                <tr>
                    <th scope="col">{{ __('Client Name') }}</th>
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
    var bill = @json($bill);
    load_table_bill(bill);
});
function load_table_bill(value)
{
    $("#table_bill").DataTable({
        processing  : false,
        ordering    : true,
        select      : false,
        destroy     : true,
        responsive  : true,
        data        : value,
        "order"     : [[0, 'desc']],
        "columnDefs": [
        {
          "defaultContent": "",
          "targets": '_all'
        }],
        columns: [
        {data:'user_name', searchable: true, visible: true, className:'text-center', defaultContent:null},
        {
            data: null,
            searchable: false,
            className: "text-center",
            render: function (data, type, row) {
                var btn = "";

                btn += ' <a  href="javascript:show_bill('+"'"+ data.id +"'"+ ');" class="btn btn-outline-primary btn-sm btn-icon" title="{{ __('Show Bill') }}" >\n' +
                '                <i class="fas fa-eye"></i>\n' +
                '            </a>';

                return btn;
            }
        }
        ]
    });
}
function check_in()
{
    $.get("check_in", function (data){
        if(data.status == 1){
            $.get("loadBills", function(data){
                load_table_bill(data);
            },'json');
        }
        toastr[data.type](data.message, data.tittle,{
            "progressBar": true,
            "onclick": null,
            "positionClass": "toast-bottom-center"
        });
    },'json');
}
function show_bill(id)
{
    $.get("show_bill/"+id, function (data){
        $("#remoteModal .modal-content").html(data);
        $("#remoteModal").modal("show");
    },'html');
}
</script>
@endsection