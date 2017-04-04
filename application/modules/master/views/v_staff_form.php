<?php
if($mode=='edit'){
    $dt = $data_staff->row();
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
                    <a href="javascript:;">Master</a>
                    <i class="fa fa-circle"></i>
                </li>
				<li>
                    <a href="<?php echo site_url() ?>staff">staff</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="javascript:;">Add New staff</a>
                    <i class="fa fa-circle"></i>
                </li>
            </ul>
            <div class="page-toolbar">
            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> staff
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
                            <form class="horizontal-form" id="form_staff" enctype="multipart/form-data">
                    			<div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                                    </div>
                                    <div class="row">
                    					<div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label"> Name *</label>
                                                <input type="text" name="staff_name" id="staff_name" class="form-control" value="" placeholder="Staff Name" />
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Gender *</label>
                                                <select class="form-control" name="staff_gender" id="staff_gender" required>
                                                    <option> </option>
                                                    <option value="M">Male</option>
                                                    <option value="F">Female</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label class="control-label">Address *</label>
                                                <input type="text" name="staff_address" id="staff_address" class="form-control" value="<?php echo @$dt->staff_address ?>" placeholder="staff address" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Telephone *</label>
                                                <input type="text" name="staff_tlp" id="staff_tlp" class="form-control" value="" placeholder="staff telephone " />
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Position *</label>
                                                <input type="text" name="staff_position" id="staff_position" class="form-control" value="" placeholder="staff staff_position" />
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label class="control-label">Photo</label>
                                                <input type="file" name="staff_photo" id="staff_photo" class="form-control file" value="<?php echo base_url().'/uploads/staff/'.@$dt->staff_photo ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label class="control-label">Is Active *</label>
                                                <select class="form-control" name="staff_active" id="staff_active">
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
                								echo '<input type="hidden" name="id" value="'.@$dt->staff_id.'">';
                                				echo '<button type="submit" class="btn green">Update</button>';
                                			}
                                			?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php elseif ($mode=='edit'): ?>
                            <form class="horizontal-form" id="form_staff_edit" enctype="multipart/form-data">
                    			<div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                                    </div>
                                    <div class="row">
                    					<div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label"> Name *</label>
                                                <input type="text" name="staff_name" id="staff_name" class="form-control" value="<?php echo @$dt->staff_name ?>" placeholder="Staff Name" />
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Gender *</label>
                                                <select class="form-control" name="staff_gender" id="staff_gender" required>
                                                    <option value="M" <?php echo @$dt->staff_name =='M' ? 'selected="selected"' : '' ?>>Male</option>
                                                    <option value="F" <?php echo @$dt->staff_name =='F' ? 'selected="selected"' : '' ?>>Female</option>
                                                     
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="control-label">Address *</label>
                                                <input type="text" name="staff_address" id="staff_address" class="form-control" value="<?php echo @$dt->staff_address ?>" placeholder="staff address" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Telephone *</label>
                                                <input type="text" name="staff_tlp" id="staff_tlp" class="form-control" value="<?php echo @$dt->staff_tlp ?>" placeholder="staff telephone " />
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Position *</label>
                                                <input type="text" name="staff_position" id="staff_position" class="form-control" value="<?php echo @$dt->staff_position ?>" placeholder="staff staff_position" />
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <?php if (@$dt->staff_photo != ''): ?>
                                                <div class="form-group">
                                                    <label class="control-label">Last Photo </label>
                                                    <br>
                                                    <img src="<?php echo base_url().'/uploads/staff/'.@$dt->staff_photo ?>" alt="" width="200" height="200"/>
                                                </div>
                                            <?php endif; ?>
                                            <div class="form-group">
                                                <label class="control-label">Upload Photo </label>
                                                <input type="file" name="staff_photo" id="staff_photo" class="form-control file"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Is Active *</label>
                                                <select class="form-control" name="staff_active" id="staff_active">
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
                								echo '<input type="hidden" name="id" value="'.@$dt->staff_id.'">';
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
$('#staffgroup_id').select2({
    placeholder: 'Select staff Group',
});
$("#staff_photo").fileinput({
	'showUpload':false,
	'previewFileType':'any',
	allowedFileExtensions : ['jpg', 'jpeg', 'png']
});

function btnInsert () {
	// var formData = $('#form_staff').serialize();
    var formData = new FormData($('#form_staff')[0]);
	$.ajax({
		url: '<?php echo site_url(); ?>/staff/create_action',
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
        				window.location.replace('<?php echo site_url() ?>staff');
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
	// var formData = $('#form_staff').serialize();
    var formData = new FormData($('#form_staff_edit')[0]);
	$.ajax({
		url: '<?php echo site_url(); ?>/staff/update_action',
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
        				window.location.replace('<?php echo site_url() ?>staff');
        			});
		}
	})
	.fail(function() {
		console.log("error");
	});
}

</script>
