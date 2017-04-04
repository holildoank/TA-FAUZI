<div class="col-sm-6">
    <div class="form-group">
        <label>Name :*</label>
        <!-- <input type="text" name="f1-facebook" placeholder="Facebook..." class="f1-facebook form-control" id="f1-facebook"> -->
        <input type="text" name="customer_name" value="" id="customer_name" class="form-control form-reserve" placeholder="Name">
        <input type="hidden" name="jam_kepilih" value="<?php echo @$jam_kepilih ?>" id="jam_kepilih" class="form-control form-reserve" placeholder="Name">

    </div>
</div>
<div class="col-sm-6">
    <div class="form-group">
      <label>Email :*</label>
      <input type="email" name="customer_email" id="customer_email" value="" class="form-control form-reserve" placeholder="email">
    </div>
</div>
<div class="clearfix">

</div>
<div class="col-sm-6">
    <div class="form-group">
      <label>Phone :*</label>
      <input type="text" name="customer_phone" id="customer_phone" value="" class="form-control form-reserve" placeholder="phone">
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group">
      <label>Comment :*</label>
      <textarea class="form-control" name="reservation_request" id="reservation_request" rows="1" cols="8"></textarea>
    </div>
</div>
<div class="f1-buttons">
    <button type="button" class="btn btn-previous btn-lg btn-sub btn-space">Previous</button>
    <button type="submit" class="btn btn-submit btn-lg btn-sub btn-space">Submit</button>
</div>

<script type="text/javascript">
// previous step
$('.f1 .btn-previous').on('click', function() {
    // navigation steps / progress steps
    var current_active_step = $(this).parents('.f1').find('.f1-step.active');
    var progress_line = $(this).parents('.f1').find('.f1-progress-line');

    $(this).parents('content').fadeOut(400, function() {
        // change icons
        current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
        // progress bar
        bar_progress(progress_line, 'left');
        // show previous step
        $(this).prev().fadeIn();
        // scroll window to beginning of the form
        scroll_to_class( $('.f1'), 20 );
    });
});


// submit
$('.f1').on('submit', function(e) {


});
</script>
