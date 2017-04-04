<?php
if($data_reservation->num_rows >0 ){
}
$dr = @$data_reservation->row();
?>
<h3 class="block">Biodata Reservation</h3>
<div class="form-group">
    <label class="control-label col-md-3">FullName
        <span class="required"> * </span>
    </label>
    <div class="col-md-4">
        <input type="text" name="customer_name" id="customer_name" class="form-control" value="<?php echo @$dr->customer_name ?>"  />
        <input type="hidden" name="reservation_tgl_mulai_pilih" id="reservation_tgl_mulai_pilih" class="form-control" value="<?php echo @$reservation_tgl_mulai_pilih ?>"  />
        <input type="hidden" name="reservation_tgl_selesai_pilih" id="reservation_tgl_selesai_pilih" class="form-control" value="<?php echo @$reservation_tgl_selesai_pilih ?>"  />
        <span class="help-block"> </span>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3">Email
        <span class="required"> * </span>
    </label>
    <div class="col-md-4">
        <input type="text" name="customer_email" id="customer_email" class="form-control" value="<?php echo @$dr->customer_email ?>" placeholder="customer email" />
        <span class="help-block"> </span>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3">Phone
        <span class="required"> * </span>
    </label>
    <div class="col-md-4">
        <input type="text" name="customer_phone" id="customer_phone" class="form-control" value="<?php echo @$dr->customer_phone ?>" placeholder="Customer Phone" />
        <span class="help-block"> </span>
    </div>
</div>
