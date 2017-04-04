
<div class="container-fluid title-container">
    <div class="container">
        <div class="title-single">
            <h2>OUR MOMENTS</h2>
            <p>THIS IS OUR MOMENTS</p>
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url() ?>">Home</a></li>
                <li class="active">Our Moments</li>
            </ol>
        </div>
    </div>
</div>

<div class="container gallery-single">
    <div class="row">
        <?php if ($data_gallery->num_rows()==1): ?>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"></div>
        <?php elseif ($data_gallery->num_rows()==2): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"></div>
        <?php elseif ($data_gallery->num_rows()==3): ?>
            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12"></div>
        <?php endif ?>
       <?php foreach ($data_gallery->result() as $r): ?>
       <?php
            $asli         = $r->gallery_file;
           $tanpa_ext    = preg_replace('/\.[^.\s]{3,4}$/', '', $asli);
           $pathinfo     = pathinfo($asli);
           $ext          = $pathinfo['extension'];
           $thumb        = $tanpa_ext.'_thumb.'.$ext;
           ?>
              <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                  <div class="hovereffect">
                       <?php echo '<img class="img-responsive" src="'.base_url().'/uploads/gallery/'.$thumb.'" alt="...">' ?>
                      <div class="overlay">
                          <p>
                              <?php echo '<a class="group2" href="'.base_url().'/uploads/gallery/'.$r->gallery_file.'" title="'.$r->gallery_desc.'">View</a>' ?>
                          </p>
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
                    Copyright (c) 2017 Copyright Mustika Musik Kamal All Rights Reserved.
                </p>
            </div>
        </div>

    </div>
</div>



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
