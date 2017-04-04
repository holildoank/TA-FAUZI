<?php
if($mode=='edit'){
    $dt = $data_product->row();
}
?>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="javascript:;">Frontend</a>
                    <i class="fa fa-circle"></i>
                </li>
				<li>
                    <a href="<?php echo site_url() ?>product">product</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="javascript:;">Add New product</a>
                    <i class="fa fa-circle"></i>
                </li>
            </ul>
            <div class="page-toolbar">
            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">product
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <span class="caption-subject bold uppercase"><?php echo $judul ?></span>
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php if ($mode=='add'): ?>
                            <form class="horizontal-form" id="form_product" enctype="multipart/form-data">
                    			<div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                                    </div>
                                    <div class="row">
                    					          <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Name *</label>
                                                <input type="text" name="product_name" id="product_name" class="form-control" value="<?php echo @$dt->product_name ?>" placeholder="Product Name" />
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label class="control-label">Description</label>
                                                <textarea name="product_desc" class="form-control" rows="2" placeholder="Description"><?php echo @$dt->product_desc ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label">Service*</label>
                                                <select class="form-control"  name="service_id" id="service_id">
                                                    <option></option>
                                                    <?php foreach ($m_service->result() as $r): ?>
                                                        <?php echo '<option value="'.$r->service_id.'">'.$r->service_name.'</option>' ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Staff*</label>
                                                <select class="form-control" name="staff_id" id="staff_id">
                                                    <option></option>
                                                    <?php foreach ($m_staff->result() as $r): ?>
                                                        <?php echo '<option value="'.$r->staff_id.'">'.$r->staff_name.'</option>' ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="harga" id="harga">

                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Duraction *</label>
                                                <input type="text" name="product_duration" id="product_duration" class="form-control" value="<?php echo @$dt->product_duration ?>" placeholder="harus Angka tidak boleh gunakan titik atau koma" />

                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label">Is Active*</label>
                                                <select class="form-control" name="product_active" id="product_active">
                                                    <option value="y">Yes</option>
                                                    <option value="n">No</option>
                                                </select>
                                            </div>

                    					</div>
                    				</div>
                    			</div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <?php
                                			if($mode=='add'){
                                				echo '<button type="submit" class="btn blue">Add</button>';
                                			}elseif($mode=='edit'){
                								echo '<input type="hidden" name="id" value="'.@$dt->product_id.'">';
                                				echo '<button type="submit" class="btn green">Update</button>';
                                			}
                                			?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php elseif ($mode=='edit'): ?>
                            <form class="horizontal-form" id="form_product_edit" enctype="multipart/form-data">
                    			<div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                                    </div>
                                    <div class="row">
                    					<div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Name *</label>
                                                <input type="text" name="product_name" id="product_name" class="form-control" value="<?php echo @$dt->product_name ?>" placeholder="Product Name" />
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Description</label>
                                                <textarea name="product_desc" class="form-control" rows="2" placeholder="Description"><?php echo @$dt->product_desc ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Service*</label>
                                                <select class="form-control"   name="service_id" id="service_id">
                                                    <option></option>
                                                    <?php foreach ($m_service->result() as $r): ?>
                                                         <?php $service = $r->service_id==@$dt->service_id ? 'selected' : '' ?>
                                                        <?php echo '<option value="'.$r->service_id.'"'.$service.'>'.$r->service_name.'</option>' ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <input type="hidden" name="harga_women" id="harga_women" value="<?php echo @$dt->product_price_men ?>">
                                            <input type="hidden" name="harga_men" id="harga_men" value="<?php echo @$dt->product_price ?>">
                                            <div class="form-group">
                                                <label class="control-label">Staff*</label>
                                                <select class="form-control" name="staff_id" id="staff_id">
                                                    <option></option>
                                                    <?php foreach ($m_staff->result() as $r): ?>
                                                        <?php $staff=$r->staff_id==@$dt->staff_id ? 'selected' : '' ?>
                                                        <?php echo '<option value="'.$r->staff_id.'" '.$staff.'>'.$r->staff_name.'</option>' ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="harga" id="harga">

                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Duraction *</label>
                                                <input type="text" name="product_duration" id="product_duration" class="form-control" value="<?php echo @$dt->product_duration ?>" placeholder="harus Angka tidak boleh gunakan titik atau koma" />

                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Is Active*</label>
                                                <select class="form-control" name="product_active" id="product_active">
                                                    <option value="y" <?php echo @$dt->product_active=='y' ? 'selected' : '' ?>>Yes</option>
                                                    <option value="n" <?php echo @$dt->product_active=='n' ? 'selected' : '' ?>>No</option>
                                                </select>
                                            </div>

                    					</div>
                    				</div>
                    			</div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <?php
                                			if($mode=='add'){
                                				echo '<button type="submit" class="btn blue">Add</button>';
                                			}elseif($mode=='edit'){
                								echo '<input type="hidden" name="id" value="'.@$dt->product_id.'">';
                                				echo '<button type="submit" class="btn green">Update</button>';
                                			}
                                			?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php endif; ?>

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

<script type="text/javascript">
mode = <?php echo json_encode($mode) ?>;

$.fn.select2.defaults.set( "theme", "bootstrap" );
$('#product_active').select2({});

$.fn.select2.defaults.set( "theme", "bootstrap" );
$('#service_id').select2({});

$.fn.select2.defaults.set( "theme", "bootstrap" );
$('#staff_id').select2({});

$("#product_file").fileinput({
	'showUpload':false,
	'previewFileType':'any',
	allowedFileExtensions : ['jpg', 'jpeg', 'png']
});
$('#service_id').change(function(e) {
    e.preventDefault();
    var service_id=$('#service_id').val();
    var harga_men=$('#harga_men').val();
    var harga_women=$('#harga_women').val();
        $('#harga').load('<?php echo site_url() ?>/product/get_harga', {service_id:service_id,harga_men:harga_men,harga_women:harga_women}, function() {

    });
});
function btnInsert () {
	// var formData = $('#form_user').serialize();
  ///form_user di ganti form_product
    var formData = new FormData($('#form_product')[0]);
	$.ajax({
		url: '<?php echo site_url(); ?>/product/create_action',
		type: 'post',
        data: formData,
        contentType: false,
        processData: false,
	})
	.done(function(res) {
		if(res.stat){
            swal({
        				title: "Success!",
        				text: "Your data has been saved.",
        				type: "success",
        				showCancelButton: false,
        				confirmButtonClass: "btn-info",
        				confirmButtonText: "Done!",
        				closeOnConfirm: false
        			},
        			function(){
        				window.location.replace('<?php echo site_url() ?>product');
        			});
		}else{
            NotifikasiToast({
				type : 'error', // ini tipe notifikasi success,warning,info,error
				msg : res.pesan, //ini isi pesan
				title : 'Error', //ini judul pesan
			});
        }
	})
	.fail(function() {
		console.log("error");
	});
}

function btnUpdate () {
	// var formData = $('#form_user').serialize();
    var formData = new FormData($('#form_product_edit')[0]);
	$.ajax({
		url: '<?php echo site_url(); ?>/product/update_action',
		type: 'post',
		data: formData,
        contentType: false,
        processData: false,
	})
	.done(function(res) {
		if(res.stat){
            swal({
        				title: "Success!",
        				text: "Your data has been updated.",
        				type: "success",
        				showCancelButton: false,
        				confirmButtonClass: "btn-info",
        				confirmButtonText: "Done!",
        				closeOnConfirm: false
        			},
        			function(){
        				window.location.replace('<?php echo site_url() ?>product');
        			});
		}
	})
	.fail(function() {
		console.log("error");
	});
}
if(mode=='edit'){
    $('#service_id').trigger('change');
}
</script>
