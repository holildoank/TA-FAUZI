
<select class="form-control selectpicker" name="product_id" id="product_id" >
       <option value="" >-- Select Hair Stylish --</option>
         <?php foreach ($data_product->result() as $r): ?>
            <?php echo '<option value="'.$r->product_id.'" >'.$r->product_name.'</option>' ?>
        <?php endforeach ?>
</select>

<script type="text/javascript">
$('.selectpicker').selectpicker({
    style: 'btn-select',
    size: 8
    });
</script>