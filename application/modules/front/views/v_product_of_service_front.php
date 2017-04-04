<?php
if ($data_service->num_rows() > 0) {
$dt = $data_service->row();?>
<div class="container-fluid title-container">
    <div class="container">
        <div class="title-single">
            <h2><?php echo $dt->service_name ?> SERVICES</h2>
            <p>THIS IS <?php echo $dt->service_name ?>  SERVICES</p>
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url()?>">Home</a></li>
                <li class="active">Haircut Services</li>
            </ol>
        </div>
    </div>
</div>

<div class="container blank">
    <div class="navigate">
        <ul>
            <li class="active"><a href="<?php echo site_url().'frontservice/detail/1' ?>">Haircut</a></li>
            <li><a href="<?php echo site_url().'frontservice/detail/2' ?>">Make Up</a></li>
            <li><a href="<?php echo site_url().'frontservice/detail/3' ?>">Threatment</a></li>
        </ul>
    </div>
</div>

<div class="container blank">
   <div class="row">
      <?php foreach ($data_product->result() as $r): ?>
         <div class="col-md-6">
             <div class="hair">
                 <div class="hair-stylish">
                     <?php echo '<img  src="'.base_url().'/uploads/staff/'.$r->staff_photo.'" alt="...">' ?>
                 </div>
                 <div class="label">
                    <p><?php echo $r->service_name ?> </p>
                 </div>
                 <div class="caption-stylish">
                     <h3><?php echo $r->staff_name ?></h3>
                     <hr><i class="fa fa-scissors" aria-hidden="true"></i>
                     <ul class="caption-category">
                         <li>Product Name</li>
                         <?php if($r->service_id ==1){
                             echo'<li>Men</li>
                             <li>Women</li>';
                         }else{} ?>
                     </ul>
                     <ul class="caption-price">
                         <li>: <?php echo $r->product_name ?></li>
                          <?php if($r->service_id ==1):?>
                         <li>: Rp <?php echo $r->product_price?></li>
                         <li>: Rp <?php echo $r->product_price_men ?></li>
                     <?php else: ?>
                         <li>: Rp <?php echo $r->product_price?> </li>
                     <?php endif ?>
                     </ul>
                 </div>
             </div>
         </div>
      <?php endforeach ?>
   </div>
</div>

<div class="container-fluid footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo base_url() ?>/front/images/mustika2.png" alt="" />
            </div>
            <div class="col-md-6">
                <p class="right">
                    Copyright (c) 2017 Copyright Mustika Musik  Kamal All Rights Reserved.
                </p>
            </div>
        </div>

    </div>
</div>
<?php
  }else {
	  echo '
      <div class="container blank">
          <div class="row">
          <h3><center> DATA NOT FOUND </center></h3>
          </div>
    </div>';
  }
  ?>

<script type="text/javascript">
$(document).ready(function($){
$(".group2").colorbox({
        rel: "group2",
        transition:"fade",
        maxWidth: "98%",
        maxHeight: "98%",
        photo: true
    });
});

$(window).resize(function () {
    $(".group2").colorbox.resize({
        maxWidth: "98%",
        maxHeight: "98%"
    });
});
$(document).bind('cbox_complete', function(){
    var cboxTitleHeight = $('#cboxTitle').height();
    var cboxContentHeight = $('#cboxContent').height();
    var cboxWrapperHeight = $('#cboxWrapper').height();
    var colorboxHeight = $('#colorbox').height();

    $('#cboxMiddleLeft, #cboxMiddleRight, #cboxContent').css('height', (cboxContentHeight + cboxTitleHeight) + 'px');
    $('#cboxWrapper').css('height', (cboxWrapperHeight + cboxTitleHeight) + 'px');
    $('#colorbox').css('height', (colorboxHeight + cboxTitleHeight) + 'px');
});
</script>
