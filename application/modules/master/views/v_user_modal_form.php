<?php
if($mode=='edit'){
	$dt = $data_user->row();
}
?>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" onclick="btn_close()"></button>
			<h4 class="modal-title"><?php echo $judul ?></h4>
		</div>
		<div class="modal-body">
            <form class="horizontal-form" id="form_user">
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
								<input type="text" name="user_password" id="user_password" class="form-control" value="<?php echo @$dt->user_password ?>" placeholder="User Group" />
                            </div>
                            <div class="form-group">
                                <label class="control-label">User Group</label>
                                <select class="form-control" name="usergroup_id" id="usergroup_id">
                                    <option></option>
                                    <?php foreach ($data_usergroup->result() as $r): ?>
                                        <?php echo '<option value="'.$r->usergroup_id.'">'.$r->usergroup_name.'</option>' ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
							<div class="form-group">
								<label class="control-label">Photo</label>
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
		</div>
	</div>
</div>

<script type="text/javascript">
// jQuery(document).ready(function() {
FormValidation.init();
// });
mode = <?php echo json_encode($mode) ?>;
$("#user_photo").fileinput({
	// 'showUpload':false,
	'previewFileType':'any',
	allowedFileExtensions : ['jpg', 'jpeg', 'png']
});

function btnInsert () {
	var formData = $('#form_user').serialize();
	$.ajax({
		url: '<?php echo site_url(); ?>/user/create_action',
		type: 'post',
		data: formData
	})
	.done(function(res) {
		if(res.stat){
			NotifikasiToast({
				type : 'success', // ini tipe notifikasi success,warning,info,error
				msg : "New User has been created successfully.", //ini isi pesan
				title : 'Success', //ini judul pesan
			});
			table.ajax.reload();
			btn_close();
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
	var formData = $('#form_user').serialize();
	$.ajax({
		url: '<?php echo site_url(); ?>/user/update_action',
		type: 'post',
		data: formData
	})
	.done(function(res) {
		if(res.stat){
			NotifikasiToast({
				type : 'success', // ini tipe notifikasi success,warning,info,error
				msg : "The User has been updated successfully.", //ini isi pesan
				title : 'Sukses', //ini judul pesan
			});
			table.ajax.reload();
			btn_close();
		}
	})
	.fail(function() {
		console.log("error");
	});
}

function btn_close () {
	$('#modal_form').modal('hide');
}
</script>
