<div class="container-fluid title-container">
    <div class="container">
        <div class="title-single">
            <h2>OUR MOMENTS</h2>
            <p>THIS IS OUR GALLERY</p>
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url() ?>">Home</a></li>
                <li class="active">Our Moments</li>
            </ol>
        </div>
    </div>
</div>
  <div class="container gallery-single">
    <div class="gallery">
        <div class="container">
            <div class="row">
                <?php foreach ($data_gallery->result() as $r): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="hovereffect">
                             <?php echo '<img class="img-responsive style="width:200px; height:100px;" src="'.base_url().'/uploads/gallery/'.$r->gallery_file.'" alt="...">' ?>
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
        <p class="view-gallery">
            <a href="<?php echo site_url().'allgallery' ?>">VIEW OUR GALLERY</a>
        </p>
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
    // $(document).ready(function($){
    $(".group2").colorbox({
            rel: "group2",
            transition:"fade",
            maxWidth: "98%",
            maxHeight: "98%",
            photo: true
        });
    // });

    $(window).resize(function () {
        $(".group2").colorbox.resize({
            maxWidth: "98%",
            maxHeight: "98%"
        });
    });
</script>
