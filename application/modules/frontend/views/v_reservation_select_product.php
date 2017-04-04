<select class="form-control" name="staff_id" id="staff_id" >
	<option value="" >-- Select Hair Stylish --</option>
	<?php foreach ($data_staff->result() as $r): ?>
	 	<?php $terpilih = $r->staff_id==$staff ? 'selected' :'' ?>
	    <?php echo '<option value="'.$r->staff_id.'" '.$terpilih.'>'.$r->staff_name.'</option>' ?>
	<?php endforeach ?>
</select>
<script type="text/javascript">
$('#staff_id').change(function(e) {
	e.preventDefault();
	var staff_id = $(this).val();
	var product_id = $('#product_id').val();
	var tanggal= $('#tanggal').val();
	var jam= $('#jam').val();
	$('#biodata').load('<?php echo site_url() ?>reservation/biodata', {staff_id : staff_id, product_id:product_id,tanggal:tanggal,jam:jam}, function() {

	});
});
</script>
