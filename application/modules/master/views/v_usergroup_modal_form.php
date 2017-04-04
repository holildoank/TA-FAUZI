<?php
if($mode=='edit'){
	$dt = $data_usergroup->row();
}
?>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" onclick="btn_close()"></button>
			<h4 class="modal-title"><?php echo $judul ?></h4>
		</div>
		<div class="modal-body">
            <form class="horizontal-form" id="form_usergroup">
    			<div class="form-body">
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                    </div>
                    <div class="row">
    					<div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">User Group *</label>
                                <input type="text" name="usergroup_name" id="usergroup_name" class="form-control" value="<?php echo @$dt->usergroup_name ?>" placeholder="User Group" />
                            </div>
							<div class="form-group">
                                <label class="control-label">Description</label>
								<textarea name="usergroup_desc" class="form-control" rows="2" placeholder="Description"><?php echo @$dt->usergroup_desc ?></textarea>
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
								echo '<input type="hidden" name="id" value="'.@$dt->usergroup_id.'">';
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

function btnInsert () {
	var formData = $('#form_usergroup').serialize();
	$.ajax({
		url: '<?php echo site_url(); ?>/usergroup/create_action',
		type: 'post',
		data: formData
	})
	.done(function(res) {
		if(res.stat){
			NotifikasiToast({
				type : 'success', // ini tipe notifikasi success,warning,info,error
				msg : "New User Group has been created successfully.", //ini isi pesan
				title : 'Success', //ini judul pesan
			});
			table.ajax.reload();
			btn_close();
		}
	})
	.fail(function() {
		console.log("error");
	});
}

function btnUpdate () {
	var formData = $('#form_usergroup').serialize();
	$.ajax({
		url: '<?php echo site_url(); ?>/usergroup/update_action',
		type: 'post',
		data: formData
	})
	.done(function(res) {
		if(res.stat){
			NotifikasiToast({
				type : 'success', // ini tipe notifikasi success,warning,info,error
				msg : "The User Group has been updated successfully.", //ini isi pesan
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
