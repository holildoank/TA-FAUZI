<!-- Slider -->
<div id="carousel-example-generic" class="carousel slide banner-slider" data-ride="carousel">
<!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    </ol>

<!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <?php $i_slide = 0 ?>
        <?php foreach ($data_slide->result() as $r): ?>
            <div class="item <?php echo $i_slide==0 ? 'active' : '' ?>">
              <?php echo '<img src="'.base_url().'/uploads/slide/'.$r->slide_file.'" alt="...">' ?>
            </div>
            <?php $i_slide++ ?>
        <?php endforeach ?>
    </div>

<!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
      <!-- End Slider -->
<!-- reservasi -->
<?php echo modules::run('front/c_reservation_front/index'); ?>
<!-- end reservasi -->
<?php echo modules::run('front/c_about/index'); ?>

<div class="container-fluid action-book">
    <!-- <h2>AMAZING STYLISH AMAZING STYLE</h2> -->
    <div class="images-book">
        <img src="<?php echo base_url()?>front/images/mustika3.png" alt="" />
    </div>
    <a class="page-scroll" href="#book">BOOK NOW</a>
</div>

    <!-- service -->
    <!-- <?php echo modules::run('front/C_service_front/scror_service');?> -->
  <!-- start promotion -->
  <?php echo modules::run('front/c_promotion_front/index'); ?>
  <!-- end promo -->
  <!-- startgalery -->
  <?php echo modules::run('front/c_gallery_front/index'); ?>
  <!-- end galery -->
  <?php echo modules::run('front/c_testimonial_front/index'); ?>
  <!-- testemoni -->


<div class="container-fluid grey " id="contact">
    <div class="contact blank">
        <div class="title-content">
            <h2>CONTACT US</h2>
            <p>GET IN TOUCH WITH US</p>
            <hr><i class="fa fa-scissors" aria-hidden="true"></i>
        </div>
        <div class="container service-col">
            <div class="row">
              <div class="col-md-4">
                <div class="contact-info wow zoomIn" data-wow-delay="0">
                  <div class="icon-container">
                      <i class="fa fa-map-marker" aria-hidden="true"></i>
                  </div>
                  <p>
                      Soho Waterplace A27,
                      Apartemen Waterplace Pakuwon Indah,
                      Jawa Timur 60216
                  </p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="contact-info2 wow zoomIn" data-wow-delay="0.3s">
                    <div class="icon-container">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                    </div>
                    <p>031 - 739 3363</p>
                    <p>0896 77039 777</p>
                    <p>0821 15831 3089</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="contact-info3 wow zoomIn" data-wow-delay="0.6s">
                    <div class="icon-container">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </div>
                  <p>MustikaMusik@gmail.com</p>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid maps">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7915.073954086734!2d112.67045474141842!3d-7.293401553592124!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x24e81f3fdf63153a!2sGLAM+Hair+Culture!5e0!3m2!1sen!2sid!4v1473914401232" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
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
  $(document).ready(function() {

      var owl = $("#testimoni");

      owl.owlCarousel({
          autoPlay : true,
          pagination : false,
          singleItem:true
      });
      // Custom Navigation Events
      $(".next").click(function(){
        owl.trigger('owl.next');
      })
      $(".prev").click(function(){
        owl.trigger('owl.prev');
      })

    });

    // function konfirmasi_cek() {
    //     $.ajax({
    //         url: "<?php echo site_url('reservation/cek_konfirmasi') ?>",
    //         cache: false,
    //         success: function(msg){
    //             $("#konfirmasi").html(msg);
    //             $(".konfirmasi").html(msg);
    //         }
    //     });
    //     var waktu =setTimeout("konfirmasi_cek()",4000);
    // }
    // $(document).ready(function() {
    //     konfirmasi_cek();
    // });
</script>
