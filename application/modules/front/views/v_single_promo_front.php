<div class="container-fluid title-container">
    <div class="container">
        <div class="title-single">
            <h2>OUR PROMOTION</h2>
            <p>ON GOING PROMOTION</p>
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url() ?>">Home</a></li>
                <li class="active">OUR PROMOTION</li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid"  id="promotion">
    <div class="container blank">
        <div class="promotion">
            <div class="title-content">
                <h2>ON GOING PROMOTION</h2>
                <hr>
                <i class="fa fa-scissors" aria-hidden="true"></i>
            </div>
            <div class="upcoming-events">
                <div class="row">
                    <?php if ($data_promotion->num_rows()==1): ?>
                        <div class="col-md-4"></div>
                    <?php elseif ($data_promotion->num_rows()==2): ?>
                        <div class="col-md-2"></div>
                    <?php endif ?>
                    <?php foreach ($data_promotion->result() as $r): ?>
                        <div class="col-md-4">
                            <div class="event">
                                <!-- <img src="http://placehold.it/370x447" alt="" /> -->
                                <?php echo '<img class="img-responsive" style="width:370px; height:447px;"   src="'.base_url().'/uploads/promotion/'.$r->promotion_file.'" alt="...">' ?>
                                <div class="abt-event">
                                    <span><?php echo date('d-M-Y H:i', strtotime(@$r->promotion_endat)) ?></span>
                                    <h3><a href="#" title=""><?php echo $r->promotion_name ?></a></h3>
                                    <ul class="countdown" id="promotion_<?php echo $r->promotion_id ?>" data-promotion-endat="<?php echo $r->promotion_endat ?>">
                                        <li><span class="days">00</span><p class="days_ref">DAYS</p></li>
                                        <li><span class="hours">00</span><p class="hours_ref">HOURS</p>	</li>
                                        <li><span class="minutes">00</span><p class="minutes_ref">MINTS</p></li>
                                        <li><span class="seconds">00</span><p class="seconds_ref">SECS</p></li>
                                    </ul>
                                    <p class="detail">
                                        <a href="#" data-toggle="modal" data-target="#myModal" onclick="event.preventDefault();btn_detail(<?php echo $r->promotion_id ?>);">Detail</a>
                                    </p>
                                </div>
                            </div><!-- Event -->
                        </div>
                    <?php endforeach ?>
                </div>
            </div><!-- Upcoming Event -->
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
     /* ============ Count Down ================*/
    $( "ul.countdown" ).each(function() {
        var id = $(this).attr('id');
        $('#'+id).downCount({
            date: $(this).attr('data-promotion-endat'),
            // offset: +10
        });
    });
    function btn_detail(id) {
    $("#myModal").load('<?php echo site_url(); ?>/frontpromotion/detail/'+id,function() {
        $(this).modal("show");
    });
}
</script>
