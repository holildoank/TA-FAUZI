<?php
if($mode=='edit'){
	$dt = $data_scheduler->row();
}
?>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" onclick="btn_close()"></button>
			<h4 class="modal-title"><?php echo $judul ?></h4>
		</div>
		<div class="modal-body">
            <form class="horizontal-form" id="form_validate_time_schedule">
    			<div class="form-body">
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                    </div>
                    <div class="row">
    					<div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Staff*</label>
                                <select class="form-control" name="staff_id" id="staff_id">
                                    <option></option>
                                    <?php foreach ($data_staff->result() as $r): ?>
                                         <?php $pilih = $r->staff_id==@$dt->staff_id ? 'selected' : '' ?>
                                        <?php echo '<option value="'.$r->staff_id.'"'.$pilih.'>'.$r->staff_name.'</option>' ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
							<div class="form-group">
								<label for="control-label">Tanggal</label>
								<div class="input-group input-medium date schedule_date"  data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
								   <input type="text" name="schedule_date"value="<?php echo date('d-M-Y', strtotime(@$dt->schedule_date)) ?>" id="schedule_date" class="form-control" readonly>
								   <span class="input-group-btn">
									   <button class="btn default" type="button">
										   <i class="fa fa-calendar"></i>
									   </button>
								   </span>
								</div>
							</div>
                            <div class="form-group">
                               <div class="col-ms-4">
                                    <label class="control-label ">Start Time *</label>
                                    <div class="input-group">
										<input type="text" name="schedule_starttime" value="<?php echo date('H:i', strtotime(@$dt->schedule_starttime)) ?>" id="schedule_starttime" class="form-control timepicker timepicker-24">
		                                <span class="input-group-btn">
		                                    <button class="btn default" type="button">
		                                        <i class="fa fa-clock-o"></i>
		                                    </button>
		                                </span>
                                    </div>
                                </div>
                                <div class="col-m-4">
                                    <label class="control-label ">Finish Time *</label>
                                    <div class="input-group">
										<input type="text" name="schedule_enddatime" value="<?php echo date('H:i', strtotime(@$dt->schedule_enddatime)) ?>" id="schedule_enddatime" class="form-control timepicker timepicker-24">
		                                <span class="input-group-btn">
		                                    <button class="btn default" type="button">
		                                        <i class="fa fa-clock-o"></i>
		                                    </button>
		                                </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Is Active*</label>
                                <select class="form-control" name="schedule_active" id="schedule_active">
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
								echo '<input type="hidden" name="id" value="'.@$dt->schedule_staff_id.'">';
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
<script src="<?php echo base_url() ?>/assets/awank/scripts/front_time_scheduler.js" type="text/javascript"></script>

<script type="text/javascript">
// jQuery(document).ready(function() {
FormValidation.init();
// });
mode = <?php echo json_encode($mode) ?>;

$(".schedule_date").datepicker({
    rtl:App.isRTL(),
    orientation:"left",autoclose:!0}
);
$(".timepicker-24").timepicker({
    autoclose:!0,
    minuteStep:5,
    showSeconds:!1,
    showMeridian:!1
});

function btnInsert () {
	var formData = $('#form_validate_time_schedule').serialize();
	$.ajax({
		url: '<?php echo site_url(); ?>/schedule/create_action',
		type: 'post',
		data: formData
	})
	.done(function(res) {
		if(res.stat){
			NotifikasiToast({
				type : 'success', // ini tipe notifikasi success,warning,info,error
				msg : "New Time Schedule Staff has been created successfully.", //ini isi pesan
				title : 'Success', //ini judul pesan
			});
			table.ajax.reload();
			btn_close();
		}
        else{
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
	var formData = $('#form_validate_time_schedule').serialize();
	$.ajax({
		url: '<?php echo site_url(); ?>/schedule/update_action',
		type: 'post',
		data: formData
	})
	.done(function(res) {
		if(res.stat){
			NotifikasiToast({
				type : 'success', // ini tipe notifikasi success,warning,info,error
				msg : "The Time Schedule has been updated successfully.", //ini isi pesan
				title : 'Sukses', //ini judul pesan
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

function btn_close () {
	$('#modal_form').modal('hide');
}
$(".form_datetime").datetimepicker({
    autoclose: true,
    isRTL: App.isRTL(),
    format: "dd-mm-yyyy hh:ii",
    pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left")
});


</script>
