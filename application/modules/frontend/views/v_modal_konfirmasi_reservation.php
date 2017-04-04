<?php
if($mode=='modal_konfirmasi'){
	$dt = $data_reservation->row();
}
?>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" onclick="btn_close_konfirmasi()"></button>
			<h4 class="modal-title"><?php echo $judul ?></h4>
		</div>
		<div class="modal-body">
            <form class="horizontal-form" id="form_reservation">
    			<div class="form-body">
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                    </div>
                    <div class="row">
    					<div class="col-md-12">
		                    <div class="form-group">
								<label class="control-label col-md-4">No Reservation</label>
                                    <div class="col-md-8">RES#<?php echo $dt->reservation_number ?></div>
		                    </div><br>
							<div class="form-group">
								<label class="control-label col-md-4">Name</label>
                                    <div class="col-md-8"><?php echo $dt->customer_name ?></div>
		                    </div><br>
							<div class="form-group">
								<label class="control-label col-md-4">Telpon</label>
                                    <div class="col-md-8"><?php echo $dt->customer_phone ?></div>
		                    </div><br>
							<div class="form-group">
								<label class="control-label col-md-4">Email</label>
                          <div class="col-md-8"><?php echo $dt->customer_email ?></div>
		          </div><br>
							<div class="form-group">
								<label class="control-label col-md-4">Alamat</label>
                          <div class="col-md-8"><?php echo $dt->customer_alamat ?></div>
		          </div><br>
							<div class="form-group">
								<label class="control-label col-md-4">service</label>
                                    <div class="col-md-8"><?php echo $dt->service_name ?></div>
		                    </div><br>
							<div class="form-group">
								<label class="control-label col-md-4">Reservation Date</label>
                                    <div class="col-md-8"><?php echo date('d-M-Y', strtotime(@$dt->reservation_createat)) ?> </div>
		                    </div><br>
							<div class="form-group">
								<label class="control-label col-md-4">Reservation Time</label>
                                    <div class="col-md-8"><?php echo date('H:i', strtotime(@$dt->reservation_createat)) ?> </div>
		                    </div><br>
							<div class="form-group">
								<label class="control-label col-md-4">Batas Konfirmas</label>
								<div class="col-md-8"><?php echo date('H:i', strtotime(@$dt->reservation_endtime_confir)) ?> </div>
							</div><br>
							<div class="form-group">
								<label class="control-label col-md-4">Reservation Start Time</label>
                                    <div class="col-md-8"><?php echo date('d-M-Y H:i', strtotime(@$dt->reservation_startdatetime)) ?> s/d <?php echo date('d-M-Y H:i', strtotime(@$dt->reservation_enddatetime)) ?></div>
		                    </div><br>
							<div class="form-group">
								<label class="control-label col-md-4">Status Reservation</label>
                                    <div class="col-md-8"><?php echo $dt->status_payment_name ?></div>
		                    </div><br>
							<div class="form-group">
								<label class="control-label col-md-4">Amount Paid</label>
                                    <div class="col-md-8">Rp.<?php echo number_format($dt->reservation_amount_paid,0,',','.') ?></div>
		                    </div>
    					</div>
    				</div>
    			</div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-9">

                        </div>
                    </div
                </div>
            </form>
		</div>
		<div class="modal-footer">
			<a href="#" onclick="event.preventDefault();btn_konfirmasi_pending(<?php echo $dt->reservation_id ?>)" '.$kon.' class="btn btn-success" title="konfirmasi pembayaran">Confirmation Pending</a>
			<a href="#" onclick="event.preventDefault();btn_konfirmasi_cencel(<?php echo $dt->reservation_id ?>)" '.$kon.' class="btn btn-danger" title="konfirmasi pembayaran">Cencel Reservation</a>
			<a href="#" onclick="event.preventDefault();btn_konfirmasi_payment(<?php echo $dt->reservation_id ?>)" '.$kon.' class="btn green" title="konfirmasi pembayaran">Confirmation Payment</a>
		</div>
	</div>
</div>

<script type="text/javascript">
FormValidation.init();
mode = <?php echo json_encode($mode) ?>;
function btnkonfirmasi () {
	var formData = $('#form_reservation').serialize();
	$.ajax({
		url: '<?php echo site_url(); ?>/reservation/konfirmasi',
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

function btn_close_konfirmasi () {
	$('#modal_view_konfirmasi').modal('hide');
}

function btn_konfirmasi_payment(id) {
	var sure = confirm('Are you sure ?');
	if (sure) {
		$.post('<?php echo site_url() ?>/reservation/konfirmasi/'+id, {}, function(res) {
			table.ajax.reload();
			btn_close_konfirmasi();
			swal({
				title: "Confirmation!",
				text: "The S has been confirmation.",
				type: "success",
				confirmButtonClass: "btn-success"
			});
		});
	}
}
function btn_konfirmasi_pending(id) {
	var sure = confirm('Are you sure ?');
	if (sure) {
		$.post('<?php echo site_url() ?>/reservation/pending/'+id, {}, function(res) {
			table.ajax.reload();
			btn_close_konfirmasi();
			swal({
				title: "Confirmation!",
				text: "The S has been confirmation.",
				type: "success",
				confirmButtonClass: "btn-success"
			});
		});
	}
}
function btn_konfirmasi_cencel(id) {
	var sure = confirm('Are you sure ?');
	if (sure) {
		$.post('<?php echo site_url() ?>/reservation/cencal/'+id, {}, function(res) {
			table.ajax.reload();
			btn_close_konfirmasi();
			swal({
				title: "Cencal!",
				text: "The S has been Cencal.",
				type: "success",
				confirmButtonClass: "btn-success"
			});
		});
	}
}

</script>
