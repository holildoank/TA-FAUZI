<?php
  $dt = $data_promotion->row();
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="btn_close()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><?php echo $dt->promotion_name ?></h4>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class="col-md-6">
                  <div class="images-modal">
                      <?php echo '<img class="img-responsive" src="'.base_url().'/uploads/promotion/'.$dt->promotion_file.'" alt="...">' ?>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="modal-desc">
                      <p>
                      <?php echo $dt->promotion_desc ?>
                      </p>
                  </div>
              </div>
          </div>
         <!-- <div class="modal-abt-event">
             <h4>Promotion Until</h4>
             <ul class="countdown" id="promotion_<?php echo $dt->promotion_id ?>" data-promotion-endat="<?php echo $dt->promotion_endat ?>">
                 <li><span class="days">00</span><p class="days_ref">DAYS</p></li>
                 <li><span class="hours">00</span><p class="hours_ref">HOURS</p>	</li>
                 <li><span class="minutes">00</span><p class="minutes_ref">MINTS</p></li>
                 <li><span class="seconds">00</span><p class="seconds_ref">SECS</p></li>
             </ul>
         </div> -->
         <div class="clearfix"></div>
      </div>
    </div>
</div>
<script type="text/javascript">
   /* ============ Count Down ================*/
    $( ".countdown" ).each(function() {
        var id = $(this).attr('id');
        // console.log(id);

        $('#'+id).downCount({
            date: $(this).attr('data-promotion-endat'),
            // offset: +10
        });
    });

function btn_close () {
  $('#myModal').modal('hide');
  }
</script>
