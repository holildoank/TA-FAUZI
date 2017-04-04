<?php
if($mode=='edit'){
    $dt = $data_creation->row();
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
                    <a href="<?php echo site_url() ?>creation">creation</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="javascript:;">Add New creation</a>
                    <i class="fa fa-circle"></i>
                </li>
            </ul>
            <div class="page-toolbar">
            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">creation
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
                            <form class="horizontal-form" id="form_creation" enctype="multipart/form-data">
                    			<div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                                    </div>
                                    <div class="row">
                    					<div class="col-md-8">
                                            <div class="form-group">
                                                <label class="control-label">Pic</label>
                                                <input type="file" name="creation_file" id="creation_file" class="form-control file" value="<?php echo base_url().'/uploads/creation/'.@$dt->creation_file ?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Description *</label>
                                                <textarea name="creation_desc" rows="2" id="creation_desc" class="form-control"><?php echo @$dt->creation_desc ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label">Service*</label>
                                                <select class="form-control" name="service_id" id="service_id">
                                                    <option></option>
                                                    <?php foreach ($m_service->result() as $r): ?>
                                                        <?php echo '<option value="'.$r->service_id.'">'.$r->service_name.'</option>' ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Is Active*</label>
                                                <select class="form-control" name="creation_active" id="creation_active">
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
                								echo '<input type="hidden" name="id" value="'.@$dt->creation_id.'">';
                                				echo '<button type="submit" class="btn green">Update</button>';
                                			}
                                			?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php elseif ($mode=='edit'): ?>
                            <form class="horizontal-form" id="form_creation_edit" enctype="multipart/form-data">
                    			<div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                                    </div>
                                    <div class="row">
                    					<div class="col-md-12">
                                            <?php if (@$dt->creation_file != ''): ?>
                                                <div class="form-group">
                                                    <label class="control-label">Last Pic </label>
                                                    <br>
                                                    <img src="<?php echo base_url().'/uploads/creation/'.@$dt->creation_file ?>" alt="" width="200" height="200"/>
                                                </div>
                                            <?php endif; ?>
                							<div class="form-group">
                                                <label class="control-label">Upload Photo </label>
                                                <input type="file" name="creation_file" id="creation_file" class="form-control file"/>
                                            </div>
                                             <div class="form-group">
                                                <label class="control-label">Description *</label>
                                                <textarea name="creation_desc" rows="2" id="creation_desc" class="form-control"><?php echo @$dt->creation_desc ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Service*</label>
                                                <select class="form-control" name="service_id" id="service_id">
                                                    <option></option>
                                                    <?php foreach ($m_service->result() as $r): ?>
                                                         <?php $service = $r->service_id==@$dt->service_id ? 'selected' : '' ?>
                                                        <?php echo '<option value="'.$r->service_id.'"'.$service.'>'.$r->service_name.'</option>' ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Is Active*</label>
                                                <select class="form-control" name="creation_active" id="creation_active">
                                                    <option value="y" <?php echo @$dt->creation_active=='y' ? 'selected' : '' ?>>Yes</option>
                                                    <option value="n" <?php echo @$dt->creation_active=='n' ? 'selected' : '' ?>>No</option>
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
                								echo '<input type="hidden" name="id" value="'.@$dt->creation_id.'">';
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
$('#creation_active').select2({});
$.fn.select2.defaults.set( "theme", "bootstrap" );
$('#service_id').select2({});

$("#creation_file").fileinput({
	'showUpload':false,
	'previewFileType':'any',
	allowedFileExtensions : ['jpg', 'jpeg', 'png']
});

function btnInsert () {
	// var formData = $('#form_user').serialize();
  ///form_user di ganti form_creation
    var formData = new FormData($('#form_creation')[0]);
	$.ajax({
		url: '<?php echo site_url(); ?>/creation/create_action',
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
        				window.location.replace('<?php echo site_url() ?>creation');
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
    var formData = new FormData($('#form_creation_edit')[0]);
	$.ajax({
		url: '<?php echo site_url(); ?>/creation/update_action',
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
        				window.location.replace('<?php echo site_url() ?>creation');
        			});
		}
	})
	.fail(function() {
		console.log("error");
	});
}

</script>
