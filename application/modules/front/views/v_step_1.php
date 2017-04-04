<div class="col-md-12">
    <div class="form-group">
        <label class="control-label">Services :*</label>
        <input type="button" required="required" id="btn_hidden" value="" style="display:none">
          <select class="selectpicker form-control aa" name="staff_id" id="staff_id f1-first-name">
                  <?php foreach ($data_service_reservation->result() as $r): ?>
                     <?php echo '<option value="'.$r->service_id.'" >'.$r->service_name.'</option>' ?>
                 <?php endforeach ?>
          </select>
    </div>
</div>
<div class="col-sm-9">
    <div class="form-group">
        <label class="control-label">Date :*</label>
        <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
            <input type="text" class="form-control form-reserve class-datepicker" readonly>
            <span class="input-group-btn">
                <button class="btn default date-set" type="button">
                    <i class="fa fa-calendar"></i>
                </button>
            </span>
        </div>

    </div>
</div>
<div class="col-sm-3">
    <div class="f1-buttons">
        <button type="button" class="btn btn-next pull-right btn-lg btn-sub btn-space" id="btn_next_1">Next</button>
    </div>
</div>
<script type="text/javascript">
$('.date-picker').datepicker({
  autoOpen: false,
    orientation: "left",
    autoclose: true
});
</script>
