<?php foreach ($ar_staff->result() as $f): ?>
    <?php
    $staff_id = $f->staff_id;
    $asli         = $f->staff_photo;
    $tanpa_ext    = preg_replace('/\.[^.\s]{3,4}$/', '', $asli);
    $pathinfo     = pathinfo($asli);
    $ext          = $pathinfo['extension'];
    $thumb        = $tanpa_ext.'_thumb.'.$ext;
    ?>
<div class="stylish-detail">
<div class="col-xs-4">
    <div class="stylish">
        <!-- <img class="centered-and-cropped" src="front/images/men-hair.jpg" /> -->
        <?php echo '<img class="centered-and-cropped" src="'.base_url().'/uploads/staff/'.$thumb.'" /> ' ?>
    </div>
</div>
<div class="col-xs-4 form-group">
    <h3><?php echo @$f->staff_name  ?></h3>
    <div class="checkbox-container">
        <?php foreach ($arr_product->result() as $dp): ?>
            <?php if ($dp->staff_id==$staff_id): ?>
                <label class="input-group">
                    <span>
                        <input type="radio"  data-staff="<?php echo $f->staff_id ?>" class="radio_product_id" name="product_id"  value="<?php echo $dp->product_id ?>" /><?php echo @$dp->product_name ?>
                    </span>
                </label>
            <?php endif; ?>
        <?php endforeach; ?>

    </div>
</div>
<div class="col-xs-4">
    <div class="form-group jam" id="jam_<?php echo $f->staff_id?>">
        <label for="date-set">Time :*</label>
        <div class="input-group">
            <input type="text" size="10" id="jamku_<?php echo $f->staff_id?>" name="jamku"  readonly class="form-control form-reserve timepicker timepicker-24">
            <span class="input-group-btn">
                <button class="btn default date-set" type="button">
                    <i class="fa fa-clock-o"></i>
                </button>
            </span>
        </div>
    </div>
</div>
</div>
<?php endforeach; ?>
