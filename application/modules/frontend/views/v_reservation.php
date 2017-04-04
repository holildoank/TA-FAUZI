<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="javascript:;">frontend</a>
                    <i class="fa fa-circle"></i>
                </li>
				<li>
                    <a href="javascript:;">reservation</a>
                    <i class="fa fa-circle"></i>
                </li>
            </ul>
            <div class="page-toolbar">
            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">reservation
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
                            <span class="caption-subject bold uppercase">List of reservation</span>
                            <a href="<?php echo site_url() ?>reservation/create" class="btn btn-primary btn-xs" id="btn_add"><i class="fa fa-plus"></i> Add New Reservation</a>

                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Product*</label>
                                <select class="form-control filter" name="service_id" id="service_id">
                                    <option  value="">All</option>
                                    <?php foreach ($m_product->result() as $r): ?>
                                                        <?php echo '<option value="'.$r->service_id.'">'.$r->service_name.'</option>' ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="col-md-5">
                            <div class="form-group">
                                <label class="control-label col-md-4">Date Range</label>
                                    <div class="input-group input-large date-picker filter input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                                        <input type="text" class="form-control" name="from">
                                        <span class="input-group-addon"> to </span>
                                        <input type="text" class="form-control" name="to"> </div>
                                    <!-- /input-group -->
                            <!-- </div> -->
                        <!-- </div> -->
                        <table class="table table-striped table-hover table-checkable dt-responsive" width="100%" id="example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Product</th>
                                    <th>Start Time</th>
                                    <th>Payment Confirmation</th>
                                    <th>Status</th>
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
<div id="modal_view_konfirmasi" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
</div>


<script type="text/javascript">
table = $('#example').DataTable({
    buttons: [
        // { extend: 'print', className: 'btn dark btn-outline' },
        // { extend: 'copy', className: 'btn red btn-outline' },
        { extend: 'pdf', className: 'btn green btn-outline' },
        { extend: 'excel', className: 'btn yellow btn-outline ' },
        { extend: 'csv', className: 'btn purple btn-outline ' }
        // { extend: 'colvis', className: 'btn dark btn-outline', text: 'Columns'}
    ],
    "processing": true,
    "serverSide": true,

    "ajax": {
        "url": "<?php echo site_url('reservation/list')?>",
        "type": "POST",
        data: function (d) {
            // alert('hahah');
            d.filter_product_id = $('#service_id').val();

        }
    },

    "columns": [

        {"orderable": false},
        {"orderable": true},
        {"orderable": true},
        {"orderable": true},
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
$('.filter').change(function(event) {
    table.ajax.reload();
});
$(".date-picker").datepicker({
    autoclose: true,
    isRTL: App.isRTL(),
    format: "dd-mm-yyyy",
    orientation: (App.isRTL() ? "bottom-right" : "bottom-left")
});
//inisialisasi class fancybox di Model
$('.fancybox').fancybox({
    openEffect  : 'elastic',
        closeEffect : 'elastic',

        helpers : {
            title : {
                type : 'inside'
            }
        }
});
function btn_edit(id) {
	$("#modal_form").load('<?php echo site_url(); ?>/reservation/update/'+id,function() {
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
				$.post('<?php echo site_url() ?>/reservation/delete/'+id, {}, function(res) {
					table.ajax.reload();
					swal({
						title: "Deleted!",
						text: "The S has been deleted.",
						type: "success",
						confirmButtonClass: "btn-success"
					});
				});
			});

}
function btn_konfirmasi(id) {
    $("#modal_view_konfirmasi").load('<?php echo site_url(); ?>/reservation/modal_konfirmasi/'+id,function() {
        $(this).modal("show");
    });
}

</script>
