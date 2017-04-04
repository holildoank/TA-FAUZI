<div class="container-fluid title-container">
    <div class="container">
        <div class="title-single">
            <h2>CLIENTS RECOMMENDATION</h2>
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url() ?>">Home</a></li>
                <li class="active">Clients Recommendation</li>
            </ol>
        </div>
    </div>
</div>

<div class="container blank">
  <div class="row">
        <?php
            function limit_words($string, $word_limit){
              $words = explode(" ",$string);
              return implode(" ",array_splice($words,0,$word_limit));
            }
            foreach ($data_testimonial->result() as $r):
            $long_string = $r->testimonial_desc;
            $testimonial_desc = limit_words($long_string, 10);
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="hovereffect-testimoni">
                    <div class="pp-testimoni">
                        <?php echo '<img    src="'.base_url().'/uploads/testimonial/'.$r->testimonial_photo.'" alt="...">' ?>

                    </div>
                <div class="testimoni-content">
                    <i><?php echo $testimonial_desc?></i>
                    <hr>
                    <h4><?php  echo $r->testimonial_name?></h4>
                </div>
                <div class="overlay">
                    <p>
                        <a href="#" data-toggle="modal" data-target="#myModal" onclick="event.preventDefault();btn_detail(<?php echo $r->testimonial_id ?>);">VIEW MORE</a>
                    </p>
                </div>
              </div>
            </div>
        <?php endforeach ?>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>
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
                    Copyright (c) 2017 Copyright Mustika Musik Kamal  All Rights Reserved.
                </p>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    function btn_detail(id) {
        // alert('haha');
        $('#myModal').load('<?php echo site_url(); ?>/testimonialfront/detail2/'+id,function(){
            // alert('haha');
            $(this).modal("show");
        });


    }
</script>
