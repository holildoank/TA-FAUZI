<?php
if($mode=='edit'){
    $dt = $data_slide->row();
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
                    <a href="<?php echo site_url() ?>slide">slide</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="javascript:;">Add New Slide</a>
                    <i class="fa fa-circle"></i>
                </li>
            </ul>
            <div class="page-toolbar">
            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">Slide
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
                            <form class="horizontal-form" id="form_slide" enctype="multipart/form-data">
                    			<div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                                    </div>
                                    <div class="row">
                    					<div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Pic</label>
                                                <input type="file" name="slide_file" id="slide_file" class="form-control file" value="<?php echo base_url().'/uploads/slide/'.@$dt->slide_file ?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Order *</label>
                                                <input type="text" name="slide_order" id="slide_order" class="form-control" value="<?php echo @$dt->slide_order ?>"  />
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Is Active*</label>
                                                <select class="form-control" name="slide_active" id="slide_active">
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
                								echo '<input type="hidden" name="id" value="'.@$dt->slide_id.'">';
                                				echo '<button type="submit" class="btn green">Update</button>';
                                			}
                                			?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php elseif ($mode=='edit'): ?>
                            <form class="horizontal-form" id="form_slide_edit" enctype="multipart/form-data">
                    			<div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                                    </div>
                                    <div class="row">
                    					<div class="col-md-12">
                                            <?php if (@$dt->slide_file != ''): ?>
                                                <div class="form-group">
                                                    <label class="control-label">Last Pic </label>
                                                    <br>
                                                    <img src="<?php echo base_url().'/uploads/slide/'.@$dt->slide_file ?>" alt="" width="200" height="200"/>
                                                </div>
                                            <?php endif; ?>
                							<div class="form-group">
                                                <label class="control-label">Upload Photo </label>
                                                <input type="file" name="slide_file" id="slide_file" class="form-control file"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Order *</label>
                                                <input type="text" name="slide_order" id="slide_order" class="form-control" value="<?php echo @$dt->slide_order ?>" placeholder="User Group" />
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Is Active*</label>
                                                <select class="form-control" name="slide_active" id="slide_active">
                                                    <option value="y" <?php echo @$dt->slide_active=='y' ? 'selected' : '' ?>>Yes</option>
                                                    <option value="n" <?php echo @$dt->slide_active=='n' ? 'selected' : '' ?>>No</option>
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
                								echo '<input type="hidden" name="id" value="'.@$dt->slide_id.'">';
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
$('#slide_active').select2({});

$("#slide_file").fileinput({
	'showUpload':false,
	'previewFileType':'any',
	allowedFileExtensions : ['jpg', 'jpeg', 'png']
});

function btnInsert () {
	// var formData = $('#form_user').serialize();
  ///form_user di ganti form_slide
    var formData = new FormData($('#form_slide')[0]);
	$.ajax({
		url: '<?php echo site_url(); ?>/slide/create_action',
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
        				window.location.replace('<?php echo site_url() ?>slide');
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
    var formData = new FormData($('#form_slide_edit')[0]);
	$.ajax({
		url: '<?php echo site_url(); ?>/slide/update_action',
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
        				window.location.replace('<?php echo site_url() ?>slide');
        			});
		}
	})
	.fail(function() {
		console.log("error");
	});
}

</script>
