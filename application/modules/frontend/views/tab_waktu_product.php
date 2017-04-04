<h3 class="block">Silahkan Pilih Product dan waktu</h3>
<div class="form-group">
    <?php foreach ($data_staff->result() as $f): ?>
        <?php
        $staff_id = $f->staff_id;
        $asli         = $f->staff_photo;
        $tanpa_ext    = preg_replace('/\.[^.\s]{3,4}$/', '', $asli);
        $pathinfo     = pathinfo($asli);
        $ext          = $pathinfo['extension'];
        $thumb        = $tanpa_ext.'_thumb.'.$ext;
        ?>
        <div class="mt-actions">
            <div class="mt-action">
                <div class="mt-action-img">
                    <?php echo '<img style="width:41px; height:41px" src="'.base_url().'/uploads/staff/'.$thumb.'" /> ' ?>
                </div>
                <div class="mt-action-body">
                    <div class="mt-action-row">
                        <div class="mt-action-info ">
                            <div class="mt-action-details ">
                                <div class="mt-action-details ">
                                    <input type="hidden" value="<?php echo $f->staff_name ?>" class="form-control" readonly="readonly" name="staff_name" >
                                    <span class="mt-action-author"><?php echo $f->staff_name ?></span>
                                </div>
                                <?php foreach ($data_product->result() as $dp): ?>
                                    <?php if ($dp->staff_id==$staff_id): ?>
                                        <div class="md-radio">
                                            <input type="radio" value="<?php echo $dp->product_id ?>" data-staff="<?php echo $f->staff_id ?>" id="radio1_<?php echo $dp->product_id ?>" name="product_id" class="md-radiobtn product_id radio_product_id" <?php echo $dp->product_id ==@$product_id_update? 'checked="checked"' : '' ?>>
                                            <label for="radio1_<?php echo $dp->product_id ?>">
                                                <span></span>
                                                <span class="check box"></span>
                                                <span class="box"></span>
                                                <!-- <?php echo @$dp->product_id?> -->
                                                <input type="text" value="<?php echo $dp->product_name ?>" class="form-control" readonly="readonly" name="product_name" >
                                            </label>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="mt-action-datetime jam" id="jam_<?php echo $f->staff_id?>">
                            <div class="input-group">
                                <input type="text" id="jamku_<?php echo $f->staff_id?>" value="<?php echo date('H:i', strtotime(@$jam_update)) ?>" name="jamku" class="form-control timepicker timepicker-24">
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-clock-o"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="mt-action-buttons "></div>
                        <div class="mt-action-buttons "></div>
                        <div class="mt-action-buttons "></div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<script type="text/javascript">
$(".timepicker-24").timepicker({
    autoclose:!0,
    minuteStep:5,
    showSeconds:!1,
    showMeridian:!1
});

$('.jam').hide();
$('.radio_product_id').click(function(event) {
    var staff_id=$(this).attr('data-staff');
    $('.jam').hide();
    $('#jam_'+staff_id).show();
});
if(mode=='edit'){
    var staff_id = $('.radio_product_id:checked').attr('data-staff');
    $('.jam').hide();
    $('#jam_'+staff_id).show();
}


</script>
