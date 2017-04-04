<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="javascript:;">Master</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="javascript:;">Service</a>
                    <i class="fa fa-circle"></i>
                </li>
            </ul>
            <div class="page-toolbar">
            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Service
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">List of Service</span>
                            <button type="button" class="btn btn-primary btn-xs" name="button" id="btn_add"><i class="fa fa-plus"></i> Add New</button>
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-hover table-checkable dt-responsive" width="100%" id="example">
                            <thead>
                               <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Harga /Jam</th>
                                    <th>Is Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>

<div id="modal_form" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
</div>

<!-- <div id="modal_view_kunjungan" class="modal fade bs-modal-lg" tabindex="-1" data-backdrop="static" data-keyboard="false">
</div> -->

<script type="text/javascript">
table = $('#example').DataTable({
    buttons: [
        { extend: 'print', className: 'btn dark btn-outline' },
        { extend: 'copy', className: 'btn red btn-outline' },
        { extend: 'pdf', className: 'btn green btn-outline' },
        { extend: 'excel', className: 'btn yellow btn-outline ' },
        { extend: 'csv', className: 'btn purple btn-outline ' },
        { extend: 'colvis', className: 'btn dark btn-outline', text: 'Columns'}
    ],
    "processing": true,
    "serverSide": true,

    "ajax": {
        "url": "<?php echo site_url('service/list')?>",
        "type": "POST",
        data: function (d) {

        }
    },

    "columns": [

        {"orderable": false},
        {"orderable": true},
        {"orderable": true},
        {"orderable": true},
        {"orderable": true},
        {"orderable": false}
    ],
    "order": [
        [2, "asc"]
    ],
    "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

});

$("#btn_add").click(function(e) {
    e.preventDefault();
    $("#modal_form").load('<?php echo site_url(); ?>/service/create',function() {
        $(this).modal("show");
    });
});

function btn_edit(id) {
    $("#modal_form").load('<?php echo site_url(); ?>/service/update/'+id,function() {
        $(this).modal("show");
    });
}

function btn_delete(id) {
    swal({
                title: "Are you sure?",
                text: "Your will not be able to recover this data!",
                type: "warning",
                showCancelButton: true,
                cancelButtonClass: "btn-default",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, Delete it!",
                closeOnConfirm: false
            },
            function(){
                $.post('<?php echo site_url() ?>/service/delete/'+id, {}, function(res) {
                    table.ajax.reload();
                    swal({
                        title: "Deleted!",
                        text: "The User Group has been deleted.",
                        type: "success",
                        confirmButtonClass: "btn-success"
                    });
                });
            });

}

</script>
