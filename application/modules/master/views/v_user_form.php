<?php
if($mode=='edit'){
    $dt = $data_user->row();
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
                    <a href="<?php echo site_url() ?>user">User</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="javascript:;">Add New User</a>
                    <i class="fa fa-circle"></i>
                </li>
            </ul>
            <div class="page-toolbar">
            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> User
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
                            <form class="horizontal-form" id="form_user" enctype="multipart/form-data">
                    			<div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                                    </div>
                                    <div class="row">
                    					<div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">User Name *</label>
                                                <input type="text" name="user_username" id="user_username" class="form-control" value="<?php echo @$dt->user_username ?>" placeholder="User Name" />
                                            </div>
                							<div class="form-group">
                                                <label class="control-label">Password *</label>
                								<input type="password" name="user_password" id="user_password" class="form-control" value="<?php echo @$dt->user_password ?>" placeholder="User Password" />
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">User Group *</label>
                                                <select class="form-control" name="usergroup_id" id="usergroup_id">
                                                    <option></option>
                                                    <?php foreach ($data_usergroup->result() as $r): ?>
                                                        <?php echo '<option value="'.$r->usergroup_id.'">'.$r->usergroup_name.'</option>' ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                							<div class="form-group">
                								<label class="control-label">Photo</label>
                								<input type="file" name="user_photo" id="user_photo" class="form-control file" value="<?php echo base_url().'/uploads/user/'.@$dt->user_photo ?>"/>
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
                								echo '<input type="hidden" name="id" value="'.@$dt->user_id.'">';
                                				echo '<button type="submit" class="btn green">Update</button>';
                                			}
                                			?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php elseif ($mode=='edit'): ?>
                            <form class="horizontal-form" id="form_user_edit" enctype="multipart/form-data">
                    			<div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                                    </div>
                                    <div class="row">
                    					<div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">User Name *</label>
                                                <input type="text" name="user_username" id="user_username" class="form-control" value="<?php echo @$dt->user_username ?>" placeholder="User Group" />
                                            </div>
                							<div class="form-group">
                                                <label class="control-label">Password *</label>
                								<input type="text" name="user_password" id="user_password" class="form-control" placeholder="Kosongkan jika tidak ingin diganti" />
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">User Group *</label>
                                                <select class="form-control" name="usergroup_id" id="usergroup_id">
                                                    <option></option>
                                                    <?php foreach ($data_usergroup->result() as $r): ?>
                                                        <?php $terpilih = $r->usergroup_id==@$dt->usergroup_id ? 'selected' : '' ?>
                                                        <?php echo '<option value="'.$r->usergroup_id.'" '.$terpilih.'>'.$r->usergroup_name.'</option>' ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <?php if (@$dt->user_photo != ''): ?>
                                                <div class="form-group">
                    								<label class="control-label">Last Photo </label>
                                                    <br>
                                                    <img src="<?php echo base_url().'/uploads/user/'.@$dt->user_photo ?>" alt="" width="200" height="200"/>
                    							</div>
                                            <?php endif; ?>
                							<div class="form-group">
                								<label class="control-label">Upload Photo </label>
                								<input type="file" name="user_photo" id="user_photo" class="form-control file"/>
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
                								echo '<input type="hidden" name="id" value="'.@$dt->user_id.'">';
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
$('#usergroup_id').select2({
    placeholder: 'Select User Group',
});
$("#user_photo").fileinput({
	'showUpload':false,
	'previewFileType':'any',
	allowedFileExtensions : ['jpg', 'jpeg', 'png']
});

function btnInsert () {
	// var formData = $('#form_user').serialize();
    var formData = new FormData($('#form_user')[0]);
	$.ajax({
		url: '<?php echo site_url(); ?>/user/create_action',
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
        				window.location.replace('<?php echo site_url() ?>user');
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
    var formData = new FormData($('#form_user_edit')[0]);
	$.ajax({
		url: '<?php echo site_url(); ?>/user/update_action',
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
        				window.location.replace('<?php echo site_url() ?>user');
        			});
		}
	})
	.fail(function() {
		console.log("error");
	});
}

</script>
