<?php
if($mode=='edit'){
	$dt = $data_service->row();
}
?>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" onclick="btn_close()"></button>
			<h4 class="modal-title"><?php echo $judul ?></h4>
		</div>
		<div class="modal-body">
            <form class="horizontal-form" id="form_service">
    			<div class="form-body">
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                    </div>
                    <div class="row">
    					<div class="col-md-12">
              <div class="form-group">
                  <label class="control-label">Service *</label>
                  <input type="text" name="service_name" id="service_name" class="form-control" value="<?php echo @$dt->service_name ?>" placeholder="Service" />
              </div>
							<div class="form-group">
                  <label class="control-label">Tarif *</label>
                  <input type="text" name="service_harga" id="service_harga" class="form-control" value="<?php echo @$dt->service_harga ?>" placeholder="Harga/Tarif" />
              </div>
							<div class="form-group">
                  <label class="control-label">PerJam *</label>
                  <input type="text" name="hitungan_jam" id="hitungan_jam" class="form-control" value="<?php echo @$dt->hitungan_jam ?>" placeholder="Masukan Hitungan Jam" />
              </div>
							<div class="form-group">
                                <label class="control-label">Description</label>
								<textarea name="service_desc" class="form-control" rows="2" placeholder="Description"><?php echo @$dt->service_desc ?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Is Active*</label>
                                <select class="form-control" name="service_active" id="service_active">
                                    <option value="y" <?php echo @$dt->service_active=='y' ? 'selected' : '' ?>>Yes</option>
                                    <option value="n" <?php echo @$dt->service_active=='n' ? 'selected' : '' ?>>No</option>
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
								echo '<input type="hidden" name="id" value="'.@$dt->service_id.'">';
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
	var formData = $('#form_service').serialize();
	$.ajax({
		url: '<?php echo site_url(); ?>/service/create_action',
		type: 'post',
		data: formData
	})
	.done(function(res) {
		if(res.stat){
			NotifikasiToast({
				type : 'success', // ini tipe notifikasi success,warning,info,error
				msg : "New Service has been created successfully.", //ini isi pesan
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
	var formData = $('#form_service').serialize();
	$.ajax({
		url: '<?php echo site_url(); ?>/service/update_action',
		type: 'post',
		data: formData
	})
	.done(function(res) {
		if(res.stat){
			NotifikasiToast({
				type : 'success', // ini tipe notifikasi success,warning,info,error
				msg : "The Service has been updated successfully.", //ini isi pesan
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
