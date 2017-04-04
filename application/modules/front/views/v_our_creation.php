<?php
if ($data_service->num_rows() > 0) {
 $dt = $data_service->row();
 ?>
<div class="container-fluid title-container">
    <div class="container">
        <div class="title-single">
            <h2><?php echo $dt->service_name ?></h2>
            <p>OUR CREATIONS <?php echo $dt->service_name ?></p>
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url()?>">Home</a></li>
                <li class="active"><?php echo $dt->service_name ?>t</li>
            </ol>
        </div>
    </div>
</div>
<div class="container blank">
    <div class="navigate">
        <ul>
            <li class="active"><a href="<?php echo site_url().'creation/detail/4' ?>">Women Haircut</a></li>
            <li><a href="<?php echo site_url().'creation/detail/5' ?>">Men Haircut</a></li>
            <li><a href="<?php echo site_url().'creation/detail/6' ?>">All Over Color</a></li>
        </ul>
    </div>
</div>
<div class="container blank">
    <div class="row">
        <?php foreach ($data_creation->result() as $r): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="hovereffect">
                    <?php echo '<img class="img-responsive " src="'.base_url().'/uploads/creation/'.$r->creation_file.'" alt="">'?>
                    <div class="overlay">
                        <p>
                        <?php echo '<a class="group2"  href="'.base_url().'/uploads/creation/'.$r->creation_file.'" title="'.$r->creation_desc.' ">View</a>'?>
                        </p>
                    </div>
                </div>
            </div>
    <?php endforeach ?>
    </div>
</div>
<?php
  }else {
      echo '
      <div class="container blank">
          <div class="row">
          <h3><center> DATA NOT FOUND </center></h3>
          </div>
    </div>
          ';
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
