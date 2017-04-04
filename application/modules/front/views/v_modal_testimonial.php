<?php
  $dt = $data_testimonial->row();
?>
<br><br>
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">TESTIMONIAL <?php echo $dt->testimonial_name ?></h4>
      </div>
      <div class="modal-body">
          <div class="pp-testimoni">
              <?php echo '<img     src="'.base_url().'/uploads/testimonial/'.$dt->testimonial_photo.'" alt="...">' ?>

          </div>
          <div class="testimoni-content">
              <i><?php echo $dt->testimonial_desc ?></i>
              <hr>
              <h4><?php echo  $dt->testimonial_name?></h4>
          </div>
      </div>
    </div>
</div>
