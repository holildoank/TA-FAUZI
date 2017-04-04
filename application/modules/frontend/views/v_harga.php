<?php

if($service_id==1): ?>
<div class="form-group">
    <label class="control-label">Price Men *</label>
    <input type="text" name="product_price_men" id="product_price_men" class="form-control" value="<?php echo @$harga_women ?>" placeholder="Rp.90000" />
</div>
<div class="form-group">
    <label class="control-label">Price Women *</label>
    <input type="text" name="product_price" id="product_price" class="form-control" value="<?php echo @$harga_men ?>" placeholder="Rp.90.0000" />
</div>
<?php else:?>
    <div class="form-group">
        <label class="control-label">Price *</label>
        <input type="text" name="product_price" id="product_price" class="form-control" value="<?php echo @$harga_men ?>" placeholder="Rp.90.0000" />
    </div>
<?php endif; ?>
